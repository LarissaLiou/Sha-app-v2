const searchParams = new URLSearchParams(window.location.search)
const event_id = searchParams.get('event_id')
if (!event_id){
    window.location.href = "index.php?filename=home"
}

async function registerForEvent(event_id){
    const response = await postRequest('backend/Events/register_event.php',{"event_id":event_id})
    if (response['error']){
        alert(response['error'])
    }
    else{
        alert("Successfully Registered")
    }
}
function fillEventDetails(eventDetails){
    const eventImage = document.querySelector('#eventImage')
    const eventName = document.querySelector('.eventName')
    const eventAttendees = document.querySelector('#eventAttendees')
    const eventPrice = document.querySelector('#eventPrice')
    const eventLocation = document.querySelector('#eventLocation')
    const eventDate = document.querySelector('#eventDate')
    const eventDescription = document.querySelector('#eventDescription')
    const visitButton = document.querySelector('#visit')
    const registerButton = document.querySelector('#register')

    eventImage.src = eventDetails.event_image
    eventName.textContent = eventDetails.event_name
    eventAttendees.textContent = `${eventDetails.min_attendees}${eventDetails.max_attendees?" - "+eventDetails.max_attendees:""} attendees`
    eventPrice.textContent = `$${eventDetails.min_price}${eventDetails.max_price?" - $"+eventDetails.max_price:""}`
    eventLocation.textContent = eventDetails.location
    eventDate.textContent = `${eventDetails.start}${eventDetails.end?" - "+eventDetails.end:""}`
    eventDescription.textContent = eventDetails.description
    visitButton.onclick = function(){
        window.open(eventDetails.event_link, '_blank')
    }

    registerButton.onclick = function(){
        registerForEvent(eventDetails.event_id)
    }

}
async function setUp(){
    const eventsResponse = await getRequest('backend/Events/event_details.php',{"event_id":event_id})
    if (eventsResponse['error'] == "No Event Found"){
        alert("Event Not Found")
        window.location.href = "index.php?filename=home"
    }
    const eventDetails = eventsResponse['event']
    fillEventDetails(eventDetails)

}

setUp()