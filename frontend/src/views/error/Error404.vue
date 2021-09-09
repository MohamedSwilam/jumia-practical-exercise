<template>
  <!-- Error page-->
  <div class="misc-wrapper">
    <div class="misc-inner p-2 p-sm-3">
      <div class="w-100 text-center">
        <b-link class="brand-logo">
          <b-img
            :src="require('@/assets/images/jumia-food.jpg')"
            alt="jumia foods logo"
            class="jumia-logo"
          />
        </b-link>
        <h2 class="mb-1">
          Page Not Found 🕵🏻‍♀️
        </h2>
        <p class="mb-2">
          Oops! 😖 The requested URL was not found on this server.
        </p>

        <b-button
          variant="primary"
          class="mb-2 btn-sm-block"
          :to="{path:'/'}"
        >
          Back to home
        </b-button>
      </div>
    </div>
  </div>
<!-- / Error page-->
</template>

<script>

export default {}
</script>

<style lang="scss">
.jumia-logo {
    max-width: 150px;
    max-height: 150px;
    border-radius: 15px;
    position: relative;
    top: -35px
}
</style>
