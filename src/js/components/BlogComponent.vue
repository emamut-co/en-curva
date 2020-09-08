<template>
  <div class="col-md-8" id="category-cards">
    <div class="col-12 mb-4">
      <a
        href="./"
        class="btn btn-light tag-button"
        data-color="<?php echo $color ?>"
        >Tags</a
      >
    </div>
    <div
      class="card mb-4 border-0"
      v-for="(post, key) in categoryArray"
      :key="key"
    >
      <div class="row no-gutters">
        <div class="col-md-6">
          <img :src="post.fimg_url" alt="" class="card-img" />
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <p
              class="card-text category"
              style="font-weight: bold"
              :style="{ color: color }"
            >
              {{ name }}
            </p>
            <a :href="post.link"
              ><h5 class="card-title text-dark text-800">
                {{ post.title.rendered }}
              </h5></a
            >
            <p class="card-text" v-html="post.excerpt.rendered"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      mainURL: '/wp-json/wp/v2/posts?filter[cat]=',
      categoryArray: [],
      tagsArray: [],
    };
  },
  props: ['id', 'color', 'name'],
  mounted: function() {
    let self = this;

    axios.get(siteURL + this.mainURL + this.id).then(function(response) {
      self.categoryArray = response.data;
    });

    axios
      .get(siteURL + '/wp-json/get_tags_in_use/v1/category/' + this.id)
      .then(function(response) {
        console.log('response', response.data);
      });
  },
};
</script>
