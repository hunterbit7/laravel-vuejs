<template>
  <aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
      <div class="aside-tools-label">
        <span><b>SPA</b></span>
      </div>
    </div>
    <div class="menu is-menu-main">
      <client-only>
        <p class="menu-label">{{ $t('side_nav.general') }}</p>
        <ul class="menu-list">
          <li>
            <nuxt-link
              tag="a"
              :to="localePath(`/`)"
              class="router-link-active has-icon"
            >
              <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
              <span class="menu-item-label">{{
                $t('side_nav.dashboard')
              }}</span>
            </nuxt-link>
          </li>
        </ul>
        <p class="menu-label">{{ $t('side_nav.pages') }}</p>
        <ul class="menu-list">
          <li>
            <nuxt-link
              tag="a"
              :to="localePath(`/my-products`)"
              class="has-icon"
            >
              <span class="icon has-update-mark"
                ><i class="mdi mdi-table"></i
              ></span>
              <span class="menu-item-label">{{ $t('side_nav.products') }}</span>
            </nuxt-link>
          </li>
          <li>
            <nuxt-link tag="a" :to="localePath(`/my-profile`)" class="has-icon">
              <span class="icon"><i class="mdi mdi-account-circle"></i></span>
              <span class="menu-item-label">{{ $t('side_nav.profile') }}</span>
            </nuxt-link>
          </li>
        </ul>
      </client-only>
    </div>
  </aside>
</template>