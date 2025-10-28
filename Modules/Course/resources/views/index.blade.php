<x-course::layouts.master>
    <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full">

        <div class="p-4">
            <div class="flex justify-between gap-2">
                <h6 class="mb-2 text-slate-800 text-xl font-semibold">Course List</h6>

                <a href="{{ route('course-make') }}" class="bg-blue-200 text-blue-950 rounded-md p-2">
                    Add Course
                </a>
            </div>

            <div class="mt-4 space-y-4">
                @forelse($getCourseList as $course)
                <a href="{{ route('course.detail', $course->course_id) }}"
                    <div class="flex justify-between items-center border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-4">
                        <img src="{{ $course->feature_image }}" alt="Course Image"
                            class="w-16 h-16 rounded object-cover border border-gray-300">

                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $course->course_title }}</h2>
                            <p class="text-sm text-gray-600">
                                {{ $course->category }} / {{ $course->level }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $course->module_count }} Modules — {{ $course->content_count }} Contents
                            </p>
                        </div>
                    </div>

                    <div class="text-right">
                        <p class="text-blue-800 font-semibold">{{ $course->course_price }} BDT</p>
                        <p class="text-gray-500 text-xs">
                            Created: {{ $course->created_at->timezone('Asia/Dhaka')->format('d M Y') }}
                        </p>
                    </div>

                </a>
                @empty
                <p class="text-gray-500 text-center">No courses found.Please add Course</p>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $getCourseList->links() }}
            </div>
        </div>

    </div>
</x-course::layouts.master>