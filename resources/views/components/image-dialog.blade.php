@props(['img' => '', 'iter'])

<!-- from cdn -->

<button id="open{{ $iter }}">
    <div class="w-20 h-20 cursor-pointer" data-dialog-target="image-dialog">
        <img alt="Image" class="object-cover object-center w-full h-full" src="{{ $img }}" />
    </div>
</button>
<dialog id="modal{{ $iter }}" class="backdrop:bg-black backdrop:bg-opacity-80">
    <button id="close{{ $iter }}"
        class="absolute text-4xl text-white mix-blend-difference top-4 right-4">X</button>
    <img alt="Image" class="w-full h-full" src="{{ $img }}" />
</dialog>
<script>
    const open{{ $iter }} = document.getElementById("open{{ $iter }}")
    const close{{ $iter }} = document.getElementById("close{{ $iter }}")
    const modal{{ $iter }} = document.getElementById("modal{{ $iter }}")

    open{{ $iter }}.addEventListener('click', (e) => {
        e.preventDefault();
        modal{{ $iter }}.showModal();
    })
    close{{ $iter }}.addEventListener('click', (e) => {
        e.preventDefault();
        modal{{ $iter }}.close();
    })
</script>
