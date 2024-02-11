@props(['message', 'success'])

<div id='message'
    class="fixed bottom-10 left-1/2 -translate-x-1/2 block w-full max-w-screen-md px-4 py-4 text-base text-white @if ($success) bg-green-500 @else bg-red-500 @endif rounded-lg font-regular"
    data-dismissible="alert">
    <div class="absolute top-4 left-4">
        @if ($success)
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                class="w-6 h-6 mt-px">
                <path fill-rule="evenodd"
                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                    clip-rule="evenodd"></path>
            </svg>
        @else
            <svg class="w-6 h-6 mt-px" viewBox="-4 -4 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"
                stroke="#ff0000" stroke-width="0.00016">
                <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
                    <rect x="-4" y="-4" width="24.00" height="24.00" rx="12" fill="#ffffff" strokewidth="0">
                    </rect>
                </g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
                    stroke-width="0.032"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M7.493 0.015 C 7.442 0.021,7.268 0.039,7.107 0.055 C 5.234 0.242,3.347 1.208,2.071 2.634 C 0.660 4.211,-0.057 6.168,0.009 8.253 C 0.124 11.854,2.599 14.903,6.110 15.771 C 8.169 16.280,10.433 15.917,12.227 14.791 C 14.017 13.666,15.270 11.933,15.771 9.887 C 15.943 9.186,15.983 8.829,15.983 8.000 C 15.983 7.171,15.943 6.814,15.771 6.113 C 14.979 2.878,12.315 0.498,9.000 0.064 C 8.716 0.027,7.683 -0.006,7.493 0.015 M8.853 1.563 C 9.967 1.707,11.010 2.136,11.944 2.834 C 12.273 3.080,12.920 3.727,13.166 4.056 C 13.727 4.807,14.142 5.690,14.330 6.535 C 14.544 7.500,14.544 8.500,14.330 9.465 C 13.916 11.326,12.605 12.978,10.867 13.828 C 10.239 14.135,9.591 14.336,8.880 14.444 C 8.456 14.509,7.544 14.509,7.120 14.444 C 5.172 14.148,3.528 13.085,2.493 11.451 C 2.279 11.114,1.999 10.526,1.859 10.119 C 1.618 9.422,1.514 8.781,1.514 8.000 C 1.514 6.961,1.715 6.075,2.160 5.160 C 2.500 4.462,2.846 3.980,3.413 3.413 C 3.980 2.846,4.462 2.500,5.160 2.160 C 6.313 1.599,7.567 1.397,8.853 1.563 M7.706 4.290 C 7.482 4.363,7.355 4.491,7.293 4.705 C 7.257 4.827,7.253 5.106,7.259 6.816 C 7.267 8.786,7.267 8.787,7.325 8.896 C 7.398 9.033,7.538 9.157,7.671 9.204 C 7.803 9.250,8.197 9.250,8.329 9.204 C 8.462 9.157,8.602 9.033,8.675 8.896 C 8.733 8.787,8.733 8.786,8.741 6.816 C 8.749 4.664,8.749 4.662,8.596 4.481 C 8.472 4.333,8.339 4.284,8.040 4.276 C 7.893 4.272,7.743 4.278,7.706 4.290 M7.786 10.530 C 7.597 10.592,7.410 10.753,7.319 10.932 C 7.249 11.072,7.237 11.325,7.294 11.495 C 7.388 11.780,7.697 12.000,8.000 12.000 C 8.303 12.000,8.612 11.780,8.706 11.495 C 8.763 11.325,8.751 11.072,8.681 10.932 C 8.616 10.804,8.460 10.646,8.333 10.580 C 8.217 10.520,7.904 10.491,7.786 10.530 "
                        stroke="none" fill-rule="evenodd" fill="#ff0000"></path>
                </g>
            </svg>
        @endif
    </div>
    <div class="ml-8 mr-12">
        <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-white">
            @if ($success)
                Success
            @else
                Error
            @endif
        </h5>
        <p class="block mt-2 font-sans text-base antialiased font-normal leading-relaxed text-white">
            {{ $message }}
        </p>
    </div>
    <button onclick="
    document.getElementById('message').classList.add('hidden')"
        class="absolute transition-all rounded-lg top-3 right-3 w-max hover:bg-white hover:bg-opacity-20">
        <div role="button" class="p-1 rounded-lg w-max">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
    </button>
</div>
