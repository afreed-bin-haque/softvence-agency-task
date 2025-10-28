<x-course::layouts.master>
    <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full">

        <div class="p-4">
            <div class="flex justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ $getCourse->feature_image }}" class="cursor-pointer" target="_blank">
                        <img src="{{ $getCourse->feature_image }}"
                            alt="{{ $getCourse->course_title }}"
                            class="w-16 h-16 rounded object-cover border border-gray-300" />
                    </a>

                    <div>
                        <h6 class="text-slate-800 text-xl font-semibold flex items-center gap-2">
                            <span class="text-green-800">{{ $getCourse->course_title }}</span>
                            <span class="text-gray-600">Course Details</span>
                        </h6>

                        <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
                            <ol class="list-none p-0 inline-flex">
                                <li class="flex items-center">
                                    <span class="text-gray-800">Course Category: {{ $getCourse->category }}</span>
                                    <span class="ml-2 mr-2">/</span>
                                </li>
                                <li>
                                    <span class="text-gray-800">Level: {{ $getCourse->level }}</span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="text-right">
                    <p class="text-blue-800 font-semibold">Price: {{ $getCourse->course_price }} BDT</p>
                    <p class="text-gray-600 text-sm pb-2">
                        Created @ {{ $getCourse->created_at->timezone('Asia/Dhaka')->format('d M Y') }}
                    </p>
                    <a href="{{ route('course-view') }}"
                        class="bg-green-200 text-green-950 rounded-md px-4 py-2 hover:bg-green-300 transition">
                        Go to list
                    </a>
                </div>
            </div>

            <div class="mt-2 w-full">
                @if($getCourse->feature_video)
                <video class="w-full rounded shadow-md" controls autoplay muted>
                    <source src="{{ $getCourse->feature_video }}" type="video/mp4">
                </video>
                @else
                <p class="text-gray-500">No feature video available.</p>
                @endif
            </div>
            <div class="mt-2 w-full">
                <p class=" font-semibold">Summery: <span class="text-green-600">{{ $getCourse->course_summery }}</span></p>
            </div>
            <div class="mt-4 w-full">
                @if($getCourse->moduleList)
                @forelse($getCourse->moduleList as $mKey => $module)
                <div class="relative flex flex-col my-6 bg-blue-50 shadow-sm border border-slate-200 rounded-lg w-full">
                    <div class="p-4">
                        <p>Module - {{ $mKey+1 }} <span class="text-green-900 font-bold"> {{$module->module_title}}</span></p>
                        <hr />
                    </div>
                    @if($module->contentList)
                    @forelse($module->contentList as $cKey => $content)
                    <a href="{{$content->video_url}}" target="_blank">
                        <div class="p-2 cursor-pointer">
                            <div class="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg w-full">
                                <div class="p-4">
                                    <p>Content - {{ $cKey + 1 }} (Click to play video here)</p>
                                    <div class="flex gap-4">
                                        <div>
                                            <span class="text-green-900 font-bold"> {{$content->content_title}}</span>
                                        </div>
                                        <div>
                                            <span class="bg-green-900 text-white text-sm p-[5px] rounded-md"> Source : {{$content->video_source}}</span>
                                        </div>
                                        <div>
                                            <p>Video Length: {{ $content->video_length }}</p>
                                        </div>
                                        <div>
                                            <p>Uploaded @ {{ $getCourse->created_at->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                    @endforeach
                    @endif
                    @endforeach
                    @endif
                </div>

            </div>

        </div>
    </div>

</x-course::layouts.master>