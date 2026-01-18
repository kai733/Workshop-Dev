document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const blogCards = document.querySelectorAll('.blog-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            const selectedCategory = this.getAttribute('data-category');

            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Filter blog cards
            blogCards.forEach(card => {
                const cardCategories = card.getAttribute('data-categories');

                if (selectedCategory === 'all') {
                    // Show all cards
                    card.style.display = 'flex';
                } else {
                    // Check if card has the selected category
                    if (cardCategories && cardCategories.split(',').includes(selectedCategory)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
