<template>
    <div>
      <div class="text-h4 text-md-h3 font-weight-bold mb-1 mb-lb-4" :class="`text-${mainColor}`">
        <slot name="main"></slot>
        {{ main }}
      </div>
      <div v-if="!hideSub" class="text-body-2 text-md-body-1 font-weight-medium md-2 mb-lg-6 mt-4"  :class="`text-${subColor}`">
        <slot name="sub"></slot>
        {{ sub }}
      </div>
    </div>

  </template>
  <script>
    export default {
      props: {
        'hide-sub': {
          default: false
        },
        sub: {},
        main: {},
        'sub-color': {
          default: 'color-dark-blue'
        },
        'main-color': {
          default: 'color-dark-blue'
        }
      }
    }
  </script>
