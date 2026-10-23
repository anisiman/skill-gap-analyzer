<x-layouts::app :title="__('Upload Resume')">
    <div class="max-w-xl">
        <h1 class="text-2xl font-semibold mb-4">Upload your resume</h1>
        <form method="POST" action="{{ route('resumes.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="resume" class="block mb-2 font-medium">Resume (PDF, max 5 MB)</label></label>
                <input type="file" name="resume" id="resume" accept=".pdf">

                @error('resume')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="px-4 py-2 rounded-lg bg-black text-white dark:bg-white dark:text-black">
                Upload
            </button>
        </form>
    </div>

</x-layouts::app>
