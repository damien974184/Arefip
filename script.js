document.addEventListener("DOMContentLoaded", () => {
    const days = document.querySelectorAll(".day");

    days.forEach(day => {
        day.addEventListener("click", () => {
            const dayNumber = day.getAttribute("data-day");

            //if (!day.classList.contains("opened")) {
                fetch("open_day.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `day=${dayNumber}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        day.classList.add("opened");
                    } else {
                        alert(data.error);
                    }
                });
            //}
        });
    });
});
