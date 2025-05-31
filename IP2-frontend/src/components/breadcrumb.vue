<template>
  <nav class="breadcrumb">
    <ul>
      <li>
        <router-link to="/" class="breadcrumb-link">Home</router-link>
        <span v-if="breadcrumbs.length > 0"> </span>
      </li>
      <li v-for="(crumb, index) in breadcrumbs" :key="index">
        <router-link
          v-if="index < breadcrumbs.length - 1"
          :to="crumb.path"
          class="breadcrumb-link"
        >
          {{ crumb.name }}
        </router-link>
        <span v-else class="breadcrumb-active">{{ crumb.name }}</span>
        <span v-if="index < breadcrumbs.length - 1"> </span>
      </li>
    </ul>
  </nav>
</template>

<script>
import { computed } from "vue";
import { useRoute, useRouter } from "vue-router";

export default {
  name: "Breadcrumb",
  setup() {
    const route = useRoute();
    const router = useRouter();

    const breadcrumbs = computed(() => {
      const pathArray = route.path.split("/").filter(Boolean);

      return pathArray
        .map((path, index) => {
          const fullPath = `/${pathArray.slice(0, index + 1).join("/")}`;
          const routeMatch = router.resolve(fullPath);

          const lastPathSegment = path.split("/").pop();
          // Use route's meta breadcrumb if available, or fallback to the path name
          const routeName = routeMatch.meta?.breadcrumb || lastPathSegment;

          return {
            name: routeName.charAt(0).toUpperCase() + routeName.slice(1),
            path: fullPath,
          };
        })
        .filter(Boolean);
    });

    return {
      breadcrumbs,
    };
  },
};
</script>

<style scoped>
.breadcrumb-link {
  font-weight: 500;
  color: #aaa9a9;
}
.breadcrumb-link:hover {
  text-decoration: underline;
  background-color: rgb(255, 255, 255);
  color: #6f665d;
}
.breadcrumb ul {
  display: flex;
  list-style: none;
  justify-content: start;
  align-items: center;
}

.breadcrumb li {
    margin-right: 1%;
    font-size: 16px;
    font-family: 'Instrument Sans', sans-serif;
    color: #6f665d;
    cursor: pointer;
}

.breadcrumb li span {
  font-weight: 500;
}

.breadcrumb li::after {
  content: " > ";
  margin-left: 8px;
}

.breadcrumb li:last-child::after {
  content: "";
}

@media (max-width: 768px) {
  .breadcrumb ul {
    justify-content: center; /* Center align breadcrumbs on tablets */
    font-size: 14px;
  }

  .breadcrumb li {
    font-size: 14px;
  }

  .breadcrumb-link {
    font-size: 14px;
  }
}

@media (max-width: 480px) {
  .breadcrumb {
    padding: 8px 10px;
  }

  .breadcrumb ul {
    justify-content: start; /* Align breadcrumbs to the left on smaller screens */
    font-size: 12px;
    gap: 3px;
  }

  .breadcrumb li {
    font-size: 12px;
  }

  .breadcrumb-link {
    font-size: 12px;
  }

  .breadcrumb li::after {
    margin: 0 3px; /* Smaller spacing for the separator */
  }
}
</style>