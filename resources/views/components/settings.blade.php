<div>
    <!-- <button @click="open = false" class="absolute right-0 font-bold">[x]</button> -->
    <h1 class="py-10 text-6xl text-center underline">Settings</h1>
    <div class="px-10 text-xl">

        {{-- set number of questions --}}
        <label for="amount">Number of Questions:</label>
        <select name="numberOfQuestions" id="numberOfQuestions" wire:model='numberOfQuestions' class="w-full py-2 mb-3 text-gray-800">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>
            <option value="50">50</option>
        </select>

        {{-- set difficulty --}}
        <label for="difficulty" class="mr-20">Difficulty:</label>
        <select name="difficulty" id="difficulty" wire:model='difficulty' class="w-full py-2 mb-3 text-gray-800">
            <option value="">Any</option>
            <option value="&difficulty=easy">Easy</option>
            <option value="&difficulty=medium">Medium</option>
            <option value="&difficulty=hard">Hard</option>
        </select>

        {{-- set category --}}
        <label for="category" class="mr-20">Category:</label>
        <select name="category" id="category" wire:model='category' class="w-full py-2 mb-3 text-gray-800">
            <option value="">Any</option>
            <option value="&category=9">General Knowledge</option>
            <option value="&category=16">Entertainment: Board Games</option>
            <option value="&category=10">Entertainment: Books</option>
            <option value="&category=32">Entertainment: Cartoon & Animations</option>
            <option value="&category=29">Entertainment: Comics</option>
            <option value="&category=11">Entertainment: Film</option>
            <option value="&category=31">Entertainment: Japanese Anime & Manga</option>
            <option value="&category=12">Entertainment: Music</option>
            {{-- <option value="&category=13">Entertainment: Musicals & Theatres</option> --}}
            <option value="&category=14">Entertainment: Television</option>
            <option value="&category=15">Entertainment: Video Games</option>
            <option value="&category=17">Science & Nature</option>
            <option value="&category=18">Science: Computers</option>
            {{-- <option value="&category=30">Science: Gadgets</option> --}}
            {{-- <option value="&category=19">Science: Mathematics</option> --}}
            <option value="&category=20">Mythologie</option>
            <option value="&category=21">Sports</option>
            <option value="&category=22">Geography</option>
            <option value="&category=23">History</option>
            {{-- <option value="&category=24">Politics</option> --}}
            {{-- <option value="&category=25">Art</option> --}}
            <option value="&category=26">Celebrities</option>
            <option value="&category=27">Animals</option>
            <option value="&category=28">Vehicles</option>
        </select>

    </div>

    <div class="flex justify-center">
        <button wire:click='saveSettings' class="py-3 my-10 font-bold bg-blue-500 border border-blue-700 rounded-lg bottom-28 px-7 hover:bg-blue-700">Start!</button>
    </div>
</div>