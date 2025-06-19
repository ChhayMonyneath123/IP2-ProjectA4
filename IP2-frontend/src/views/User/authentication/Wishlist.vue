<template>
    <div class="wishlist">
        <Nav_bar/>
        <Breadcrumb/>
        <div class="wishlist-container">
            <div class="container-content">
                <!-- Left side - Title -->
                <h1 class="wishlist-title">Wishlist</h1>

                <!-- Right side - View Menu Button -->
                <button 
                    @click="goToMenu" 
                    class="view-menu-button"
                    aria-label="Go to Menu"
                >
                    View Menu
                </button>
            </div>

            <!-- Second row - Select All and Sort -->
            <div class="controls-row">
                <!-- Left side - Select All -->
                <div class="select-all-section">
                    <label class="select-label">Selected all:</label>
                    <button 
                        @click="toggleSelectAll"
                        class="select-checkbox"
                        :class="{ 'selected': isAllSelected }"
                        aria-label="Select all items"
                    >
                        <div v-if="isAllSelected" class="checkbox-dot"></div>
                    </button>
                </div>

                <!-- Right side - Sort controls -->
                <div class="sort-controls">
                    <!-- Sort by dropdown -->
                    <div class="sort-section">
                        <span class="sort-label">Sort by:</span>
                        <div class="sort-dropdown">
                            <button 
                                @click="toggleSortDropdown"
                                class="sort-button"
                                aria-label="Sort options"
                            >
                                {{ selectedSort }}
                                <i class="fas fa-chevron-down sort-icon"></i>
                            </button>
                            
                            <transition name="dropdown-fade">
                                <div v-if="showSortDropdown" class="dropdown-menu">
                                    <button
                                        v-for="option in sortOptions"
                                        :key="option"
                                        @click="selectSort(option)"
                                        class="dropdown-item"
                                        :class="{ 'active': selectedSort === option }"
                                    >
                                        {{ option }}
                                    </button>
                                </div>
                            </transition>
                        </div>
                    </div>

                    <!-- Menu icon -->
                    <button class="menu-icon-btn" aria-label="Menu options">
                        <i class="fas fa-bars menu-icon"></i>
                    </button>
                </div>
            </div>
        </div>
        <Footer_bar/>
    </div>
</template>

<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';

export default {
    name: "WishlistContainer",
    components: {
        Footer_bar,
        Nav_bar,
        Breadcrumb
    },
    data() {
        return {
            isAllSelected: false,
            selectedSort: 'Time',
            showSortDropdown: false,
            sortOptions: ['Time', 'Name', 'Price', 'Date Added']
        };
    },
    methods: {
        goToMenu() {
            this.$router.push('/menu');
        },
        toggleSelectAll() {
            this.isAllSelected = !this.isAllSelected;
            // Add your logic here to select/deselect all wishlist items
            console.log('Select all wishlist items:', this.isAllSelected);
        },
        toggleSortDropdown() {
            this.showSortDropdown = !this.showSortDropdown;
        },
        selectSort(option) {
            this.selectedSort = option;
            this.showSortDropdown = false;
            // Add your logic here to sort wishlist items
            console.log('Sort wishlist by:', option);
        },
        // Close dropdown when clicking outside
        handleClickOutside(event) {
            if (!event.target.closest('.sort-dropdown')) {
                this.showSortDropdown = false;
            }
        }
    },
    mounted() {
        document.addEventListener('click', this.handleClickOutside);
    },
    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside);
    }
}
</script>

<style scoped>
.wishlist {
    width: 100%;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.wishlist-container {
    width: 100%;
    background-color: #f8f9fa;
    padding: 1.5rem 2rem;
    font-family: 'IBM Plex Sans Condensed', sans-serif;
    box-sizing: border-box; /* Add this to include padding in width calculation */

}

.container-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin: 2 auto;
    margin-bottom: 1rem;
}

.wishlist-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #333;
    margin: 0;
}

.view-menu-button {
    padding: 0.75rem 1.5rem;
    border: 2px solid #333;
    background: white;
    color: #333;
    cursor: pointer;
    border-radius: 0.25rem;
    font-size: 1rem;
    font-weight: 500;
    font-family: inherit;
    transition: all 0.2s ease;
}

.view-menu-button:hover {
    background-color: #333;
    color: white;
}

.view-menu-button:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

/* Controls Row */
.controls-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin: 0 auto;
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
}

.select-all-section {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.select-label {
    color: #666;
    font-size: 0.9rem;
}

.select-checkbox {
    width: 1.5rem;
    height: 1.5rem;
    border: 2px solid #999;
    border-radius: 50%;
    background: transparent;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.select-checkbox:hover {
    border-color: #666;
}

.select-checkbox.selected {
    border-color: #666;
}

.checkbox-dot {
    width: 0.75rem;
    height: 0.75rem;
    background-color: #666;
    border-radius: 50%;
}

.sort-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.sort-section {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sort-label {
    color: #666;
    font-size: 0.9rem;
}

.sort-dropdown {
    position: relative;
}

.sort-button {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    background: none;
    border: none;
    font-weight: 600;
    color: #333;
    cursor: pointer;
    font-size: 0.9rem;
    transition: color 0.2s ease;
}

.sort-button:hover {
    color: #555;
}

.sort-icon {
    font-size: 0.75rem;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 0.25rem;
    background: white;
    border: 1px solid #ddd;
    border-radius: 0.375rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    min-width: 8rem;
}

.dropdown-item {
    display: block;
    width: 100%;
    padding: 0.75rem 1rem;
    background: none;
    border: none;
    text-align: left;
    font-size: 0.875rem;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

.dropdown-item.active {
    background-color: #e9ecef;
    font-weight: 600;
}

.menu-icon-btn {
    padding: 0.25rem;
    background: none;
    border: none;
    cursor: pointer;
    border-radius: 0.25rem;
    transition: background-color 0.2s ease;
}

.menu-icon-btn:hover {
    background-color: #e9ecef;
}

.menu-icon {
    font-size: 1.25rem;
    color: #666;
}

/* Dropdown transition */
.dropdown-fade-enter-active,
.dropdown-fade-leave-active {
    transition: all 0.2s ease;
}

.dropdown-fade-enter-from,
.dropdown-fade-leave-to {
    opacity: 0;
    transform: translateY(-0.5rem);
}

/* Responsive design */
@media (max-width: 768px) {
    .wishlist-container {
        padding: 1rem;
    }
    
    .container-content {
        flex-direction: column;
        gap: 1rem;
        align-items: center;
    }
    
    .controls-row {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .wishlist-title {
        font-size: 2rem;
    }
    
    .view-menu-button {
        width: 100%;
        max-width: 200px;
    }
    
    .sort-controls {
        width: 100%;
        justify-content: space-between;
    }
}

@media (max-width: 480px) {
    .wishlist-title {
        font-size: 1.75rem;
    }
    
    .view-menu-button {
        padding: 0.65rem 1.25rem;
        font-size: 0.9rem;
    }
    
    .select-all-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>