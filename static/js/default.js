
async function postRequest(destination,data,action,secure,reportError){
    let formObject = new FormData()
    secure = secure ?? false
    data = data ?? {} 
    if (secure){
        var csrfMetaTag = document.querySelector('meta[name="csrf_token"]')
        if (!csrfMetaTag) { alert("Suspicious Change Detected. Please Reload Page."); return false}
        formObject.append('csrf_token',csrfMetaTag.getAttribute('content'))
    }
    if (data instanceof FormData) formObject = data
    else{ 
        for (const [key,value] of Object.entries(data)){
            formObject.append(key,value)
        }
    }
    let response = await fetch(destination, { method: "POST", body: formObject })
    let result
    try{
        if (reportError) result = await response.text()
        else result = await response.json()
    }
    catch (e){
        if (reportError){
            response = await fetch(destination, { method: "POST", body: formObject })
            result = await response.text()
            alert(result)
            return result
        }
        alert(e)
        return "Failure"
    }
    return action ? action(result) : result 
    
}


async function getRequest(destination,data,action,secure){
    secure = secure ?? false;
    data = data ?? {} 
    destination += "?"
    if (secure){
        var csrfMetaTag = document.querySelector('meta[name="csrf_token"]')
        if (!csrfMetaTag) { alert("Suspicious Change Detected. Please Reload Page.");return}
        destination += `csrf_token=${csrfMetaTag.getAttribute('content')}&`
    }
    for (const [key,value] of Object.entries(data)){
        destination += `${key}=${value}&`
    }
    var response = await fetch(destination, 
        { method: "GET",
        headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        }})
    var result
    try{
        result = await response.json()
    }
    catch (e){
        console.log(e)
        response = await fetch(destination, 
            { method: "GET",
            headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
            }})
        result = await response.text()
        console.log(result)
        return result
    }
    
    console.log(result)
    return action ? action(result) : result 
    
}

