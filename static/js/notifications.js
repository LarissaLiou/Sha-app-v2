const notifications_container = document.querySelector("#notifications");

function insertNotification(userData) {
    const notification = document.createElement("div");
    for (const key in userData) {
        notification.dataset[key] = JSON.stringify(userData[key]);
    }
    notification.classList.add("notification");

    const img = document.createElement("img");
    img.classList.add("notification_picture");
    img.onerror = function() {
        img.src = "static/assets/pfp.png";
    };
    notification.appendChild(img);

    const title = document.createElement("h3");
    title.classList.add("notification_title");
    title.textContent = userData.notification_title;
    notification.appendChild(title);

    const content = document.createElement("p");
    content.classList.add("content");
    content.textContent = userData.content;
    notification.appendChild(content);

    //const 

    notifications_container.appendChild(notification);
}

async function setUpNotifications() {
    const { notifications } = await getRequest("backend/Notifications/notifications.php");

    for (const notification of notifications) {
        insertNotification(notification);
    }
}

setUpNotifications();
