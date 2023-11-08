document.addEventListener('DOMContentLoaded', function () {
    const questions = document.querySelectorAll('.question');
    
    questions.forEach(question => {
        const toggle = question.querySelector('.toggle');
        const answer = question.querySelector('.answer');
        
        toggle.addEventListener('click', function () {
            if (question.classList.contains('active')) {
                question.classList.remove('active');
                answer.style.display = 'none';
            } else {
                question.classList.add('active');
                answer.style.display = 'block';
            }
        });
    });
});
