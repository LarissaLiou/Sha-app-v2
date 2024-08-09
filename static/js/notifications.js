const notifications_container = document.querySelector("#notifications");

function insertNotification(notifData) {
    const notification = document.createElement("div");
    for (const key in notifData) {
        notification.dataset[key] = JSON.stringify(notifData[key]);
    }
    notification.classList.add("notification");

    const img = document.createElement("img");
    img.classList.add("notification_picture");
    img.onerror = function() {
        img.src = "static/assets/pfp.png";
    };
    notification.appendChild(img);

    const username = document.createElement("h2");
    username.classList.add("sender_id");
    username.textContent = notifData.username;
    notification.appendChild(username); // Append the username to the notification

    const notificationTextMap = {
        0: "Someone liked your post",
        1: "Someone commented on your post",
        2: "You have a new connection request",
        3: "You were mentioned in a post",
        4: "Someone checked out your profile",
        5: "You might be interested in this"
    };
    const notifType = notifData.notification_type;
    const title = document.createElement("h3");
    title.classList.add("notification_type");
    title.textContent = notificationTextMap[notifType] || "Unknown notification type";
    notification.appendChild(title);

    const notif_time = document.createElement("h4"); // Correct the typo here
    notif_time.classList.add("created_at");
    notif_time.textContent = notifData.time;
    notification.appendChild(notif_time); // Append the time to the notification

    notifications_container.appendChild(notification);
}

async function setUpNotifications() {
    const { notifications } = await getRequest("backend/Notifications/notifications.php");

    for (const notification of notifications) {
        insertNotification(notification);
    }
}

setUpNotifications();