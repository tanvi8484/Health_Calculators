document.getElementById('calculate').addEventListener('click', function() {
    const food = document.getElementById('food').value;
    const quantity = document.getElementById('quantity').value;

    const foodData = {
        apple: { calories: 52, protein: 0.3, carbs: 14, fat: 0.2 },
        banana: { calories: 89, protein: 1.1, carbs: 23, fat: 0.3 },
        chicken: { calories: 165, protein: 31, carbs: 0, fat: 3.6 },
        rice: { calories: 130, protein: 2.7, carbs: 28, fat: 0.3 },
        broccoli: { calories: 55, protein: 3.7, carbs: 11, fat: 0.6 },
    };

    if (quantity <= 0) {
        alert("Please enter a valid quantity.");
        return;
    }

    const selectedFood = foodData[food];

    // Calculate nutrients based on the quantity (grams)
    const calories = (selectedFood.calories / 100) * quantity;
    const protein = (selectedFood.protein / 100) * quantity;
    const carbs = (selectedFood.carbs / 100) * quantity;
    const fat = (selectedFood.fat / 100) * quantity;

    // Display the results
    const results = `
        <p><strong>Calories:</strong> ${calories.toFixed(2)} kcal</p>
        <p><strong>Protein:</strong> ${protein.toFixed(2)} g</p>
        <p><strong>Carbohydrates:</strong> ${carbs.toFixed(2)} g</p>
        <p><strong>Fat:</strong> ${fat.toFixed(2)} g</p>
    `;
    document.getElementById('results').innerHTML = results;
});