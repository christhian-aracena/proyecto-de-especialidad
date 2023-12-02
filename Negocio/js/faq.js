document.addEventListener("DOMContentLoaded", function () {
    const faqContainers = document.querySelectorAll(".faq-container");

    // Itera sobre todos los contenedores de preguntas
    faqContainers.forEach(function (faqContainer) {
        // Delegación de eventos para cada contenedor
        faqContainer.addEventListener("click", function (event) {
            const target = event.target;

            // Verifica si el clic se realizó en un elemento con la clase .faq-question o .arrow
            if (target.classList.contains("faq-question") || target.classList.contains("arrow")) {
                const item = target.closest(".faq-item");

                if (item) {
                    item.classList.toggle("active");
                    const arrow = target.querySelector(".arrow");
                    arrow.textContent = item.classList.contains("active") ? "▲" : "▼";
                }
            }
        });
    });

    // Ejemplo de cómo agregar elementos dinámicamente
    // Simula cargar preguntas mediante AJAX
    // const newQuestion = document.createElement("div");
    // newQuestion.className = "faq-item";
    // newQuestion.innerHTML = `
    //     <div class="faq-question">
    //         <span class="arrow">▼</span> Pregunta Dinámica
    //     </div>
    //     <div class="faq-answer">
    //         Respuesta Dinámica
    //     </div>
    // `;

    // Agrega la nueva pregunta al primer contenedor
    faqContainers[0].appendChild(newQuestion);
});
