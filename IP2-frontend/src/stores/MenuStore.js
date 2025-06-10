import { defineStore } from 'pinia';
import sushi from '@/assets/images/sushi.png';
import mangoCake from '@/assets/images/mango_cake.png';
import amok from '@/assets/images/amok.png';
import fishCheese from '@/assets/images/fish_cheese.png';
import greenTea from '@/assets/images/sushi.png'; // update path as needed
import noodleSoup from '@/assets/images/sushi.png'; // update path as needed

export const useMenuStore = defineStore('menu', {
  state: () => ({
    popularMenuItems: [
      { imagePath: sushi, title: 'Sushi', description: 'Fresh and delicious sushi rolls.' },
      { imagePath: mangoCake, title: 'Mango Shake', description: 'Refreshing mango shake.' },
      { imagePath: amok, title: 'Amok', description: 'Traditional Cambodian fish amok.' },
      { imagePath: fishCheese, title: 'Red Velvet Cake', description: 'Rich and moist red velvet cake.' },
      { imagePath: greenTea, title: 'Green Tea', description: 'Refreshing green tea.' },
      { imagePath: noodleSoup, title: 'Noodle Soup', description: 'Hearty noodle soup.' },
      { imagePath: fishCheese, title: 'Red Velvet Cake', description: 'Rich and moist red velvet cake.' },
      { imagePath: greenTea, title: 'Green Tea', description: 'Refreshing green tea.' },
      { imagePath: noodleSoup, title: 'Noodle Soup', description: 'Hearty noodle soup.' },
    ],
    selectedCategory: null,
  }),
  actions: {
    selectCategory(category) {
      this.selectedCategory = category;
    }
  }
});
