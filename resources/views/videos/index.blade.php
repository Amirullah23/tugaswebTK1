<style>
    /* Styles for the success alert */
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
        border-radius: 4px;
    }

    /* Styles for the table */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Styles for the video player */
    video {
        width: 320px;
        height: 240px;
    }

    /* Styles for the delete button */
    form button {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Styles for the file upload form */
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

    form button[type="button"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
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
</style>


@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h1>Daftar Video</h1>

<table>
    <thead>
        <tr>
            <th>Nama File</th>
            <th>Video</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($videos as $video)
            <tr>
                <td>{{ $video->file_name }}</td>
                <td>
                    <video width="320" height="240" controls>
                        <source src="{{ asset($video->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </td>
                <td>
                    <button type="button"><a href="{{ route('videos.show', $video->id) }}">Play / Edit</a></button>
                    
                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<hr>

<h2>Unggah Video Baru</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="file_name">Nama File:</label>
    <input type="text" name="file_name" id="file_name" required>
    <br>
    <label for="video">Video:</label>
    <input type="file" name="video" id="video" accept="video/mp4,video/quicktime" required>
    <br>
    <button type="submit">Unggah</button>
</form>
