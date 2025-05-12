<?php 
/*
Template Name: Register Page
*/
get_header();
?>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Create an Account</h2>

    <form method="post" class="space-y-4">
        <input type="text" name="username" placeholder="Username" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="email" name="email" placeholder="Email" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="password" name="password" placeholder="Password" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="submit" name="register" value="Sign Up"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200" />
    </form>

    <?php
    if (isset($_POST['register'])) {
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            echo '<p class="mt-4 text-green-600 text-center">User registered successfully!</p>';
        } else {
            echo '<p class="mt-4 text-red-600 text-center">' . esc_html($user_id->get_error_message()) . '</p>';
        }
    }
    ?>
  </div>
</div>

<?php 
get_footer();
?>
