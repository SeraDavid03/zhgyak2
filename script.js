document.addEventListener('DOMContentLoaded', function() {
    // Get the form and button elements
    const commentForm = document.getElementById('comment-form');
    const toggleButton = document.getElementById('toggle-button');
    
    // Initially hide the form by setting its display to 'none'
    commentForm.style.display = 'none';
    
    // Add event listener to the button to toggle the form visibility
    toggleButton.addEventListener('click', function() {
        if (commentForm.style.display === 'none') {
            commentForm.style.display = 'block'; // Show the form
        } else {
            commentForm.style.display = 'none'; // Hide the form
        }
    });
});
