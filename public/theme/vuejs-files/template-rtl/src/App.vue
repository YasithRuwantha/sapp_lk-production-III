<template>
  <div id="app">
    <loader></loader>
   <router-view :key="$route.fullPath"> </router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
 mounted() {
    
    // Sidebar overlay
    $(".sidebar-overlay").on("click", function () {
      $('.main-wrapper').removeClass('slide-nav');
      $(".sidebar-overlay").removeClass("opened");
      $('html').removeClass('menu-opened');
    });
  
    $(document).on('click', '#toggle_btn', function () {
    if ($('body').hasClass('mini-sidebar')) {
      $('body').removeClass('mini-sidebar');
      $('.subdrop + ul').slideDown();
    } else {
      $('body').addClass('mini-sidebar');
      $('.subdrop + ul').slideUp();
    }
  
    return false;
  });
  }

}
</script>


