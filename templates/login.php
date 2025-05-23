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

<div class="w-fit m-auto !py-[70px] flex flex-col gap-[20px] items-center justify-center bg-gray-100 login_form">
    <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            if (has_custom_logo()) {
              echo '<a class="w-full bg-[#48afff] py-[15px] rounded-[5px] " href="' . esc_url(home_url('/')) . '">';
              echo '<img class="!w-[150px] m-auto" src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
              echo '</a>';

            } else {
              echo '<h1>' . get_bloginfo('name') . '</h1>';
            }
            ?>
  <div class="bg-white  rounded-[5px] shadow-lg px-[13px] md:px-[unset] w-[unset] md:w-[543px]">
    <img class="w-full rounded-t-[5px]" src="	https://static.priceoye.pk/images/login-header-img.svg" >
    <div class="p-8">
    <h2 class="text-[22px] font-bold mb-6 text-center text-gray-800">Login to Your Account</h2>

    <?php if ($login_error): ?>
      <div class="mb-4 text-red-600 font-semibold text-center">
       <h1>Login Failed</h1>
      </div>
    <?php endif; ?>

    <form method="post" action="<?php echo esc_url(wp_login_url(home_url() . '?login=success')); ?>" class="space-y-4">
        <input type="text" name="log" placeholder="Username" required
            class="w-full px-4 !mb-[10px] py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="password" name="pwd" placeholder="Password" required
            class="w-full px-4 !mb-[30px] py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="submit" value="Login"
            class="w-full bg-[#48afff] !text-white py-3 rounded-md cursor-pointer transition duration-200" />
    </form>
    <p class="text-center mt-[10px] text-[14px] font-semibold">If you don't have an account <a  href="/register" class="ml-[9px] underline text-[#48afff]">Register!</a></p>
    </div>
  </div>
</div>

<?php 
get_footer();
?>
