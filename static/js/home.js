const interestContainer = document.querySelector('.interest');
const nearbyContainer = document.querySelector('.near');

function createEventCard(container,eventDetails){
    const grid = createEle("div",['grid2'])
    const img = createEle("img",['eventImage','discoverimage'],null,{src:eventDetails.event_image})
    const divEvent = createEle("div")
    const eventNameEle = createEle("span",['eventName'],null,{'textContent':eventDetails.event_name})
    const eventCityEle = createEle("span",['eventcity'],null,{'textContent':' '+eventDetails.location})
    divEvent.appendChild(eventNameEle)
    divEvent.appendChild(eventCityEle)
    const divAttendees = createEle("div")
    const attendeesIcon = createEle("img",['smallIcons'],null,{src:"static/assets/person.png"})
    const attendeesEle = createEle("span",null,null,{"textContent":` ${eventDetails.min_attendees}${eventDetails.max_attendees?" - "+eventDetails.max_attendees:""} attendees`})
    divAttendees.appendChild(attendeesIcon)
    divAttendees.appendChild(attendeesEle)
    const divCost = createEle("div")
    const costIcon = createEle("img",['smallIcons'],null,{src:"static/assets/ticket.png"})
    const costEle = createEle("span",null,null,{"textContent":` $${eventDetails.min_price}${eventDetails.max_price?" - $"+eventDetails.max_price:""}`})
    divCost.appendChild(costIcon)
    divCost.appendChild(costEle)
    grid.appendChild(img)
    grid.appendChild(divEvent)
    grid.appendChild(divAttendees)
    grid.appendChild(divCost)
    container.appendChild(grid)
    grid.dataset.event_id = eventDetails.event_id
    grid.onclick = function(){
        window.location.href = `index.php?filename=eventInformation&event_id=${this.dataset.event_id}`
    }

}
async function setUp(){
    const eventsResponse = await getRequest('backend/Events/events.php')
    for (const event of eventsResponse['events']){
        createEventCard(interestContainer,event)
    }
    for (const event of eventsResponse['events']){
        createEventCard(nearbyContainer,event)
    }
}

setUp();