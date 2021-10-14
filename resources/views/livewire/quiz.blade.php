<div class="container h-auto max-w-4xl py-10 mx-auto mt-10 bg-gray-800 rounded-md">

@if (! $quizStarted)
    <x-settings />
@else

    @if (! $quizFinished)
        {{-- timer --}}
        <div class="flex justify-between w-full py-10 mx-10">
            <div x-data="{ countdown: @entangle('timer') }" x-init="setInterval(function(){if(countdown > 0)countdown--;}, 1000);" class="flex justify-between w-48 text-gray-800 bg-gray-300 border-4 border-gray-500 rounded-lg h-28 text-8xl ">
                <x-heroicon-o-clock class="w-14" />
                <h1 x-text="countdown"></h1>
                <template x-if="countdown == 0">
                    <div x-data x-init="$wire.emit('timeUp')"></div>
                </template>
            </div>
            <div class="flex items-center justify-between px-5 py-3 mr-20 text-gray-800 bg-gray-300 border-4 border-gray-500 rounded-lg w-52">
                <x-heroicon-o-star class="w-14" />
                <span class="text-6xl">{{ $score }}</span>
            </div>
        </div>

        <div>
            <div class="mx-10 mt-10">
                <span class="block">Category: {{ Arr::get($question, 'category') }}</span>
                <span>Difficulty: {{ Arr::get($question, 'difficulty') }}</span>
            </div>

            <div class="flex items-center justify-center h-40 px-10 py-10 mx-10 mb-5 text-2xl text-center text-gray-800 bg-gray-300 border-4 border-gray-500 rounded-lg">
                <p>
                    {!! Arr::get($question, 'question') !!}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-2 mx-10 text-center text-gray-800 bg-gray-800 rounded-lg">
                @if ($solution || $timer == 0)

                    @foreach (Arr::get($question, 'answers') as $answer)
                        <button class="py-5 flex border-4 border-gray-500 justify-around @if ($answer == Arr::get($question, 'correct_answer')) bg-green-500 @else bg-red-500 @endif rounded-lg">
                            @if ($solution == $answer)
                                <x-heroicon-s-chevron-double-right class="w-5" />
                            @endif
                            {!! $answer !!}
                            @if ($solution == $answer)
                                <x-heroicon-s-chevron-double-left class="w-5" />
                            @endif
                        </button>
                    @endforeach

                @else

                    @foreach (Arr::get($question, 'answers') as $answer)
                        @if ($solution == $answer)
                            <x-heroicon-s-chevron-double-right class="w-5" />
                        @endif
                        <button class="flex justify-center py-5 bg-gray-300 border-4 border-gray-500 rounded-lg hover:bg-gray-400" wire:click="checkAnswer('{{ $answer }}')">
                            {!! $answer !!}
                        </button>
                        @if ($solution == $answer)
                            <x-heroicon-s-chevron-double-left class="w-5" />
                        @endif
                    @endforeach

                @endif

            </div>
        </div>

        <div class="flex flex-col w-56 mx-auto mt-10">
            <button class="px-10 py-5 font-bold text-gray-300 align-middle bg-blue-500 border border-blue-700 rounded-lg hover:bg-blue-700" wire:click='nextQuestion'>@if($questionIndex < $numberOfQuestions) Next Question @else Show Results @endif</button>
            <span class="text-center">Question {{ $questionIndex }} / {{ $numberOfQuestions }}</span>
        </div>

    @else
        <div class="py-10 mx-10 text-gray-800 bg-gray-300 rounded-lg">
            <div class="py-10 text-xl text-center">
                <h1 class="pb-3 text-2xl font-bold">You scored {{ $score }} Points in @if ($numberOfQuestions == 1) 1 Question @else {{ $numberOfQuestions }} Questions @endif!</h1>
                <div>
                    <p class="pb-5 underline">
                        Your Settings:
                    </p>
                    <p>
                        Difficulty: @if ($difficulty == "") Any @else {{ Arr::get($question, 'difficulty') }} @endif
                    </p>
                    <p>
                        @if ($category == "") Categories: All @else Category: {{ Arr::get($question, 'category') }} @endif
                    </p>
                </div>
            </div>
            <hr class="pb-5 border-gray-800">
            <div class="mb-20">
                <div class="flex pb-5 mx-3">
                    <input type="text" name="player" placeholder="Type in your name to save your Highscore!" wire:keydown.enter='store()' wire:model='player' class="w-full px-3 rounded-lg">
                    <button wire:click='store()' type="button" class="py-3 font-bold text-gray-200 bg-blue-500 border border-blue-700 rounded-lg px-7 hover:bg-blue-700">Save</button>
                </div>
                <table class="w-full text-center">
                    <tr>
                        <th>Rank</th>
                        <th>Player</th>
                        <th>Difficulty</th>
                        <th>Category</th>
                        <th>Score</th>
                    </tr>
                    @foreach ($highscores as $player)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $player->player }}</td>
                            <td>
                                @if ($player->difficulty == "&difficulty=easy")
                                    Easy
                                @elseif ($player->difficulty == "&difficulty=medium")
                                    Medium
                                @elseif ($player->difficulty == "&difficulty=hard")
                                    Hard
                                @else
                                    Any
                                @endif
                            </td>
                            <td>
                                @if ($player->category == "&category=9")
                                    General Knowledge
                                @elseif ($player->category == "&category=16")
                                    Entertainment: Board Games
                                @elseif ($player->category == "&category=10")
                                    Entertainment: Books
                                @elseif ($player->category == "&category=32")
                                    Entertainment: Cartoon & Animations
                                @elseif ($player->category == "&category=29")
                                    Entertainment: Comics
                                @elseif ($player->category == "&category=11")
                                    Entertainment: Film
                                @elseif ($player->category == "&category=31")
                                    Entertainment: Japanese Anime & Manga
                                @elseif ($player->category == "&category=12")
                                    Entertainment: Music
                                @elseif ($player->category == "&category=14")
                                    Entertainment: Television
                                @elseif ($player->category == "&category=15")
                                    Entertainment: Video Games
                                @elseif ($player->category == "&category=17")
                                    Science & Nature
                                @elseif ($player->category == "&category=18")
                                    Science: Computers
                                @elseif ($player->category == "&category=20")
                                    Mythologie
                                @elseif ($player->category == "&category=21")
                                    Sports
                                @elseif ($player->category == "&category=22")
                                    Geography
                                @elseif ($player->category == "&category=23")
                                    History
                                @elseif ($player->category == "&category=26")
                                    Celebrities
                                @elseif ($player->category == "&category=27")
                                    Animals
                                @elseif ($player->category == "&category=28")
                                    Vehicles
                                @else
                                    All
                                @endif
                            </td>
                            <td>{{ $player->score }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="flex align-middle">
                <button class="px-10 py-5 mx-auto font-bold text-gray-200 bg-blue-500 border border-blue-700 rounded-lg hover:bg-blue-700" wire:click='playAgain'>Play again!</button>
            </div>

        </div>
    @endif
    @endif

</div>