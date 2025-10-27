<x-course::layouts.master>
    <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full">

        <div class="p-4">
            <div class="flex justify-between items-center gap-2">
                <h6 class="text-xl font-semibold text-slate-800">Add Course</h6>
                <a href="{{ route('course-view') }}" class="bg-green-200 text-green-950 rounded-md px-4 py-2">
                    Go to list
                </a>
            </div>

            <div class="mt-6">
                <form class="space-y-4" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                        <div>
                            <label for="courseTitle" class="block font-bold mb-2">Course Title</label>
                            <input type="text" id="courseTitle" name="courseTitle" class="border rounded w-full py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                        </div>
                        <div>
                            <label for="featureVideo" class="block font-bold mb-2">Feature Video</label>
                            <input type="file" id="featureVideo" name="featureVideo" class="border rounded w-full py-2 px-3" />
                        </div>
                        <div>
                            <label for="featureImage" class="block font-bold mb-2">Feature Image</label>
                            <input type="file" id="featureImage" name="featureImage" class="border rounded w-full py-2 px-3" />
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
                    <div class="flex justify-between items-center mb-2">
                        <h6 class="text-lg font-semibold">Modules</h6>
                        <button type="button" id="addModule" class="bg-blue-200 text-blue-900 px-3 py-1 rounded ">Add Module</button>
                    </div>

                    <div id="module" class="space-y-4"></div>

                    <button type="submit" class="bg-emerald-200 text-emerald-800 px-6 py-2 rounded  w-full">Submit Course</button>
                </form>
            </div>
        </div>

    </div>
    <script>
        let moduleIndex = 0;

        function createContent(moduleIndex, contentIndex) {
            return `
            <div class="content-item border p-4 rounded space-y-2 ">
                <div class="flex justify-between items-center">
                    <h6 class="font-semibold">Content ${contentIndex + 1}</h6>
                    <button type="button" class="removeContent bg-pink-200 text-pink-800 px-2 py-1 rounded">Remove</button>
                </div>
                <input type="text" name="module[${moduleIndex}][content][${contentIndex}][contentTitle]" placeholder="Content Title" class="border rounded w-full py-2 px-3" />
                <select name="module[${moduleIndex}][content][${contentIndex}][videoSourceType]" class="border rounded w-full py-2 px-3">
                    <option value="">Select Video Source</option>
                    <option value="youtube">YouTube</option>
                    <option value="facebook">Facebook</option>
                </select>
                <input type="text" name="module[${moduleIndex}][content][${contentIndex}][videoUrl]" placeholder="Video URL" class="border rounded w-full py-2 px-3" />
                <input type="text" name="module[${moduleIndex}][content][${contentIndex}][videoLength]" placeholder="Video Length HH:MM:SS" class="border rounded w-full py-2 px-3" />
            </div>
        `;
        }

        function createModule(moduleIndex) {
            const firstContent = createContent(moduleIndex, 0);
            return `
            <div class="module-item border p-4 rounded space-y-4 ">
                <div class="flex justify-between items-center">
                    <h5 class="font-bold text-lg">Module ${moduleIndex + 1}</h5>
                    <button type="button" class="removeModule bg-rose-200 text--rose-800 px-3 py-1 rounded">Remove Module</button>
                </div>
                <input type="text" name="module[${moduleIndex}][moduleTile]" placeholder="Module Title" class="border rounded w-full py-2 px-3 mb-2" />
                <div class="content-list space-y-2">
                    ${firstContent}
                </div>
                <button type="button" class="addContent bg-indigo-200 text-indigo-900 px-3 py-1 rounded">Add Content</button>
            </div>
        `;
        }

        $(document).ready(function() {
            $('#module').append(createModule(moduleIndex));
            moduleIndex++;

            $('#addModule').click(function() {
                $('#module').append(createModule(moduleIndex));
                moduleIndex++;
            });

            $('#module').on('click', '.removeModule', function() {
                $(this).closest('.module-item').remove();
            });

            $('#module').on('click', '.addContent', function() {
                let moduleDiv = $(this).closest('.module-item');
                let moduleIdx = moduleDiv.index();
                let contentList = moduleDiv.find('.content-list');
                let contentIdx = contentList.children().length;
                contentList.append(createContent(moduleIdx, contentIdx));
            });

            $('#module').on('click', '.removeContent', function() {
                $(this).closest('.content-item').remove();
            });
        });

        /* $('form').submit(function(e) {
            e.preventDefault();
            let form = $(this)[0];
            let formData = new FormData(form);

            let payload = {};
            formData.forEach((value, key) => {
                if (payload[key]) {
                    if (!Array.isArray(payload[key])) payload[key] = [payload[key]];
                    payload[key].push(value);
                } else {
                    payload[key] = value;
                }
            });

            console.log(payload);
        }); */
        $('form').submit(function(e) {
            e.preventDefault(); // prevent normal form submission

            // Create FormData object from this form
            let form = $(this)[0]; // get the raw DOM element
            let formData = new FormData(form); // <--- THIS DEFINES formData

            $.ajax({
                url: '{{ route("course-store") }}',
                method: "POST",
                data: formData,
                processData: false, // important for file uploads
                contentType: false, // important for file uploads
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log("Course stored successfully:", response);
                },
                error: function(xhr) {
                    console.error("Error storing course:", xhr.responseText);
                }
            });
        });
    </script>
</x-course::layouts.master>