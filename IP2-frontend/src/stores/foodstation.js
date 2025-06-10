// stores/foodStore.js
import { defineStore } from 'pinia';

import mangoCake from '@/assets/images/mango_cake.png';
import amok from '@/assets/images/amok.png';
import fishCheese from '@/assets/images/fish_cheese.png';
import redCake from '@/assets/images/red_cake.png';
import sushi from '@/assets/images/sushi.png';

export const useFoodStore = defineStore('food', {
  state: () => ({
    allFoodItems: [
      { image: mangoCake, type: 'Tea', title: 'Iced Latte', description: 'A refreshing cold drink made with espresso and milk' },
      { image: amok, type: 'Seafood', title: 'Sushi', description: 'Fresh and delicious sushi rolls' },
      { image: redCake, type: 'Dessert', title: 'Cake', description: 'Yummy cake with creamy frosting' },
      { image: fishCheese, type: 'Drink', title: 'Mango Shake', description: 'A refreshing tropical drink made with ripe mangoes' },
      { image: sushi, type: 'Fast Food', title: 'Burger', description: 'Juicy beef patty with fresh toppings' },
      { image: mangoCake, type: 'Tea', title: 'Iced Latte', description: 'A refreshing cold drink made with espresso and milk' },
      { image: amok, type: 'Seafood', title: 'Sushi', description: 'Fresh and delicious sushi rolls' },
      { image: redCake, type: 'Dessert', title: 'Cake', description: 'Yummy cake with creamy frosting' },
      { image: fishCheese, type: 'Drink', title: 'Mango Shake', description: 'A refreshing tropical drink made with ripe mangoes' },
      { image: sushi, type: 'Fast Food', title: 'Burger', description: 'Juicy beef patty with fresh toppings' },
    ],
  }),
});
