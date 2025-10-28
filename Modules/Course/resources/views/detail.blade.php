<x-course::layouts.master>
    <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full">

        <div class="p-4">
            <div class="flex justify-between gap-2">
                <div>
                    <h6 class="mb-2 text-slate-800 text-xl font-semibold">
                        <span class="text-green-800">{{ $getCourse->course_title }}</span> Course Details


                    </h6>
                    <nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
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
                <div>
                    <p class="text-blue-800">Price: {{ $getCourse->course_price }} BDT</p>
                    <p class="text-gray-600 text-sm">Created @ {{ $getCourse->created_at->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}</p>
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
                <p class="text-green-600 font-semibold">{{ $getCourse->course_summery }}</p>
            </div>
            <div class="mt-4 w-full">
                @if($getCourse->moduleList)
                @forelse($getCourse->moduleList as $module)
                <div class="relative flex flex-col my-6 bg-blue-50 shadow-sm border border-slate-200 rounded-lg w-full">
                    <div class="p-4">
                        <p>Module - <span class="text-green-900 font-bold"> {{$module->module_title}}</span></p>
                        <hr />
                    </div>
                </div>

                @endforeach
                @endif
            </div>

        </div>

    </div>
    </div>

</x-course::layouts.master>