<?php 
/*
Template Name: Login Page
*/
get_header();
?>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login to Your Account</h2>

    <form method="post" action="<?php echo esc_url( wp_login_url(home_url()) ); ?>" class="space-y-4">
        <input type="text" name="log" placeholder="Username" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="password" name="pwd" placeholder="Password" required
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="submit" value="Login"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200" />
    </form>
    <p class="text-center mt-[10px]" >if you dont have account  <a href="/register" class="underline " >Register!</a></p>
  </div>
</div>

<?php 
get_footer();
?>
