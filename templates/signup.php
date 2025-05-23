<?php 
/*
Template Name: Register Page
*/
get_header();
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
    <h2 class="text-[22px] font-bold mb-6 text-center text-gray-800">Create an Account</h2>

    <form method="post" class="space-y-4">
        <input type="text" name="username" placeholder="Username" required
            class="w-full px-4 !mb-[10px] py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="email" name="email" placeholder="Email" required
            class="w-full px-4 !mb-[10px] py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="password" name="password" placeholder="Password" required
            class="w-full px-4 !mb-[30px] py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <input type="submit" name="register" value="Sign Up"
            class="w-full bg-[#48afff] !text-white py-3 rounded-md cursor-pointer transition duration-200" />
    </form>

    <?php
    if (isset($_POST['register'])) {
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

       $user_id = wp_insert_user([
    'user_login' => $username,
    'user_pass'  => $password,
    'user_email' => $email,
    'role'       => 'customer' // or 'subscriber' or your custom role
]);

        if (!is_wp_error($user_id)) {
            echo '<p class="text-center mt-[10px] text-[14px] font-semibold">User Registered Successfully<a  href="/login" class="ml-[9px] underline text-[#48afff]">Login!</a></p>';
        } else {
            echo '<p class="text-center mt-[10px] text-[14px] font-semibold">' . esc_html($user_id->get_error_message()) . '</p>';
        }
    }
    ?>
    </div>
  </div>
</div>

<?php 
get_footer();
?>
