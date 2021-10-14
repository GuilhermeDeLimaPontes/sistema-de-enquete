<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Poll;
use App\Http\Requests\PollRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;


class PollController extends Controller
{
    public function sumVote(Request $request)
    {
        $request->validate(['name' => 'required|integer']);
        Answer::where('id', $request->name)->firstOrFail()->increment('total_votes');

        return back()->with('success', 'Voto Computado Com Sucesso');
    }

    public function showPollToVote($poll)
    {
        $poll = Poll::findOrFail($poll);
        $pollAnswers = $poll->answers()->get();
        $votes = Answer::where('poll_id', $poll->id)->sum('total_votes');

        if ($pollAnswers)
        {
            return view('poll', ['pollTitle' => $poll->title, 'pollAnswers' => $pollAnswers, 'numberOfResponses' => count($pollAnswers), 'votes' => $votes]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PollRequest $request)
    {
        $propertySlug = $this->setName($request->title);

        $poll = Poll::create(['title' => Str::title($request->title), 'slug' => $propertySlug, 'user_id' => Auth::user()->id]);

        $pollId = $poll->id;

        $numberOfResponses = count($request->answers);

        for ($i = 0; $i < $numberOfResponses; $i++)
        {
            $answer = Answer::create(['name' => $request->answers[$i], 'total_votes' => 0, 'poll_id' => $pollId]);
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        $this->authorize('poll.show.or.edit.or.delete', $poll);
        $poll = Poll::findOrFail($poll->id);
        $pollAnswers = $poll->answers()->get();
        $votes = Answer::where('poll_id', $poll->id)->sum('total_votes');

        if ($pollAnswers)
        {
            return view('show', 
            [
                'pollAnswers' => $pollAnswers,
                'pollTitle' => $poll->title,
                'numberOfResponses' => count($pollAnswers),
                'votes' => $votes
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        $this->authorize('poll.show.or.edit.or.delete', $poll);

        $poll = Poll::findOrFail($poll->id);

        $pollAnswers = $poll->answers()->get();

        if ($pollAnswers)
        {
            $pollTitle = $poll->title;

            return view('edit', ['id' => $poll->id, 'pollAnswers' => $pollAnswers, 'pollTitle' => $pollTitle, 'numberOfResponses' => count($pollAnswers)]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $poll = Poll::findOrFail($poll->id);
        $request->validate(['title'=>'required']);
    
        $poll->title = $request->title; 
        $poll->slug  = $this->setName($request->title);
        
        $slice = collect($request)->slice(3);

        if(in_array(null,$slice->toArray()))
        {
            return back()->withErrors(['error'=>'Preencha todos os campos']);
        }

        foreach ($slice as $key => $value){
            Answer::where('id', $key)->update(['name' => $value]);
        }

        $poll->save();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        $this->authorize('poll.show.or.edit.or.delete', $poll);
        Poll::destroy($poll->id);
        return redirect()->route('users.index');
    }

    private function setName($title)
    {
        $propertySlug = Str::slug($title);

        $properties = Poll::all();

        $t = 0;
        foreach ($properties as $property) 
        {
            if (Str::slug($property->title) === $propertySlug)
            {
                $t++;
            }
        }

        if ($t > 0)
        {
            $propertySlug = $propertySlug . '-' . $t;
        }
        return $propertySlug;
    }
}
