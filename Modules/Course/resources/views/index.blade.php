<x-course::layouts.master>
    <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full">

        <div class="p-4">
            <div class="flex justify-between gap-2">
                <div>
                    <h6 class="mb-2 text-slate-800 text-xl font-semibold">
                        Course List
                    </h6>
                </div>
                <div>
                    <a href="{{ route('course-make') }}"
                        class="bg-blue-200 text-blue-950 rounded-md p-2">
                        Add Course
                    </a>
                </div>
            </div>
            <p class="text-slate-600 leading-normal font-light">
                The place is close to Barceloneta Beach and bus stop just 2 min by walk
                and near to &quot;Naviglio&quot; where you can enjoy the main night life in
                Barcelona.
            </p>
        </div>

    </div>
    </div>

</x-course::layouts.master>