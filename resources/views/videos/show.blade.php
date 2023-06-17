<style>
    /* Styles for the heading */
    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    /* Styles for the video player */
    video {
        width: 640px;
        height: 480px;
        margin-bottom: 20px;
    }

    /* Styles for the error alert */
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
    }

    .alert-danger ul {
        margin-bottom: 0;
    }

    .alert-danger li {
        margin-left: 20px;
        list-style-type: disc;
    }

    /* Styles for the form */
    form label {
        display: block;
        margin-bottom: 5px;
    }

    form input[type="text"],
    form input[type="file"] {
        margin-bottom: 10px;
    }

    form button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
    }
</style>

<h1>{{ $video->file_name }}</h1>

<video controls>
    <source src="{{ asset($video->video_path) }}" type="video/mp4">
    Your browser does not support the video tag.
</video>

<hr>

<h2>Edit Video</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="file_name">Nama File:</label>
    <input type="text" name="file_name" id="file_name" value="{{ $video->file_name }}" required>
    <br>
    <label for="video">Video Baru:</label>
    <input type="file" name="video" id="video" accept="video/mp4,video/quicktime">
    <br>
    <button type="submit">Simpan</button>
</form>
