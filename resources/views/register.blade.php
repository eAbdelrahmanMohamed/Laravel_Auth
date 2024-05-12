<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h1>User Registration</h1>

    <form action="{{ route('register.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Mobile Number -->
        <div>
            <label for="mobile_number">Mobile Number:</label><br>
            <input type="text" id="mobile_number" name="mobile_number" required>
        </div>

        <!-- Password -->
        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </div>

        <!-- Username -->
        <div>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required>
        </div>

        <!-- Location (Google Maps) -->
        <div>
            <label for="location">Location (Google Maps):</label><br>
            <input type="text" id="location" name="location" required>
        </div>

        <!-- Image with Thumbnail -->
        <div>
            <label for="image">Image with Thumbnail:</label><br>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
