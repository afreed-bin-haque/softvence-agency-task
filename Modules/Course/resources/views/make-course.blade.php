<x-course::layouts.master>
    <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full">

        <div class="p-4">
            <div class="flex justify-between items-center gap-2">
                <h6 class="text-xl font-semibold text-slate-800">Add Course</h6>
                <a href="{{ route('course-view') }}" class="bg-green-200 text-green-950 rounded-md px-4 py-2 hover:bg-green-300 transition">
                    Go to list
                </a>
            </div>

            <div class="mt-6">
                <form class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                        <div>
                            <label for="courseTitle" class="block font-bold mb-2">Course Title</label>
                            <input type="text" id="courseTitle" name="courseTitle" class="border rounded w-full py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                        </div>
                        <div>
                            <label for="featureVideo" class="block font-bold mb-2">Feature Video</label>
                            <input type="file" id="featureVideo" name="featureVideo" class="border rounded w-full py-2 px-3" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                        <div>
                            <label for="level" class="block font-bold mb-2">Level</label>
                            <input type="text" id="level" name="level" class="border rounded w-full py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                        </div>
                        <div>
                            <label for="category" class="block font-bold mb-2">Category</label>
                            <select id="category" name="category" class="border rounded w-full py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="">Select Category</option>
                                <option value="Hard">Hard</option>
                            </select>
                        </div>
                        <div>
                            <label for="coursePrice" class="block font-bold mb-2">Course Price</label>
                            <input type="number" id="coursePrice" name="coursePrice" class="border rounded w-full py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                        <div class="md:col-span-3">
                            <label for="courseSummery" class="block font-bold mb-2">Course Summery</label>
                            <textarea id="courseSummery" name="courseSummery" class="border rounded w-full py-2 px-3 h-64"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-course::layouts.master>