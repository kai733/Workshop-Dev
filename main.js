document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".question-card");
    const results = {
        green: document.getElementById("result-1"),
        yellow: document.getElementById("result-2"),
        red: document.getElementById("result-3"),
    };
    const quizContainer = document.querySelector(".quiz");

    let currentCardIndex = 0;
    const userAnswers = {};

    // Initialize
    function init() {
        if (cards.length === 0) return;

        showCard(currentCardIndex);

        cards.forEach((card, index) => {
            // Handle Answer Selection
            const answers = card.querySelectorAll(".answer");
            answers.forEach((ans) => {
                ans.addEventListener("click", (e) => {
                    // Remove selected class from siblings
                    answers.forEach((a) => a.classList.remove("selected"));
                    // Add selected class to clicked
                    ans.classList.add("selected");
                    // Store value
                    userAnswers[index] = ans.dataset.value;
                });
            });

            // Handle Prev Button
            const prevBtn = card.querySelector(".prev-btn");
            if (prevBtn) {
                prevBtn.addEventListener("click", () => {
                    if (currentCardIndex > 0) {
                        showCard(currentCardIndex - 1);
                    }
                });
            }

            // Handle Next Button
            const nextBtn = card.querySelector(".next-btn");
            if (nextBtn) {
                nextBtn.addEventListener("click", () => {
                    // Validation: Check if answer selected
                    if (!userAnswers[index]) {
                        alert("Veuillez sélectionner une réponse.");
                        return;
                    }

                    if (currentCardIndex < cards.length - 1) {
                        showCard(currentCardIndex + 1);
                    } else {
                        calculateAndShowResult();
                    }
                });
            }
        });
    }

    function showCard(index) {
        // Hide all cards
        cards.forEach((card) => {
            card.classList.remove("active");
            // Ensure display is managed via CSS or manual toggle if needed.
            // Assuming CSS handles .active { display: block; } and others are hidden.
            // But just in case, let's force strict visibility if CSS is weak
            card.style.display = "none";
        });

        // Show current
        const currentCard = cards[index];
        currentCard.classList.add("active");
        currentCard.style.display = "block"; // Or flex/grid depending on design, sticking to block for safety or relies on CSS class

        currentCardIndex = index;

        // Toggle Prev Button Visibility
        const prevBtn = currentCard.querySelector(".prev-btn");
        if (prevBtn) {
            if (index === 0) {
                prevBtn.style.display = "none";
            } else {
                prevBtn.style.display = "inline-block"; // or callback to css
            }
        }
    }

    function calculateAndShowResult() {
        // Hide all cards
        cards.forEach(c => c.style.display = "none");

        // Also hide the floating images or other quiz parts if desired? 
        // The user didn't specify, but usually you hide the questions.
        // The structure has `<h2><?php echo $quiz["title"] ?></h2>` and `<p>` at the top. 
        // We might want to keep the title or hide it. Let's strictly hide the cards and show result.

        // Tally scores
        const counts = { green: 0, yellow: 0, red: 0 };
        Object.values(userAnswers).forEach(val => {
            if (counts[val] !== undefined) counts[val]++;
        });

        // Find max
        // Priority: ?? If tie? Just pick first found or default. 
        // Determine winner
        let winner = "green"; // Default
        let max = -1;

        for (const [color, count] of Object.entries(counts)) {
            if (count > max) {
                max = count;
                winner = color;
            }
        }

        // Show result
        const resultDiv = results[winner];
        if (resultDiv) {
            resultDiv.style.display = "flex"; // Using flex to assume centering or block
            // Scroll to result
            resultDiv.scrollIntoView({ behavior: 'smooth' });
        }
    }

    init();
});
