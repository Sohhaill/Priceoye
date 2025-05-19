<?php
/*
Template Name:  Login Page
*/
get_header();

// Capture error messages
$login_error = '';
if (isset($_POST['login']) && $_POST['login'] === 'failed') {
    $login_error = 'Invalid username or password. Please try again.';
}
?>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login to Your Account</h2>

    <?php if ($login_error): ?>
      <div class="mb-4 text-red-600 font-semibold text-center">
        <?php echo esc_html($login_error); ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?php echo esc_url(wp_login_url(home_url() . '?login=failed')); ?>" class="space-y-4">
        <input type="text" name="log" placeholder="Username" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="password" name="pwd" placeholder="Password" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="submit" value="Login"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200" />
    </form>
    <p class="text-center mt-[10px]">If you don't have an account <a href="/register" class="underline">Register!</a></p>
  </div>
</div>
