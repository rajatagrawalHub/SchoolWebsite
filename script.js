let boardInstagramElement  = document.querySelectorAll(".fa-instagram");

let instagramHandles = ["https://www.instagram.com/bullsandbears_vit/","https://www.instagram.com/bullsandbears_vit/","https://www.instagram.com/bullsandbears_vit/","https://www.instagram.com/bullsandbears_vit/","https://www.instagram.com/bullsandbears_vit/","https://www.instagram.com/bullsandbears_vit/","https://www.instagram.com/bullsandbears_vit/","https://www.instagram.com/bullsandbears_vit/","https://www.instagram.com/bullsandbears_vit/","https://www.instagram.com/bullsandbears_vit/"];

for(let i = 0;i < boardInstagramElement.length -1;i++){
    boardInstagramElement[i].addEventListener("click",()=>{
        window.location.href = instagramHandles[i];
    })
}

let boardLinkedElement  = document.querySelectorAll(".fa-instagram");

let LinkedHandles = ["https://www.linkedin.com/in/rajat-agrawal-36812024a/","https://www.linkedin.com/in/rajat-agrawal-36812024a/","https://www.linkedin.com/in/rajat-agrawal-36812024a/","https://www.linkedin.com/in/rajat-agrawal-36812024a/","https://www.linkedin.com/in/rajat-agrawal-36812024a/","https://www.linkedin.com/in/rajat-agrawal-36812024a/","https://www.linkedin.com/in/rajat-agrawal-36812024a/","https://www.linkedin.com/in/rajat-agrawal-36812024a/","https://www.linkedin.com/in/rajat-agrawal-36812024a/","https://www.linkedin.com/in/rajat-agrawal-36812024a/"];

for(let i = 0;i < boardLinkedElement.length -1;i++){
    boardLinkedElement[i].addEventListener("click",()=>{
        window.location.href = LinkedHandles[i];
    })
}

document.addEventListener("DOMContentLoaded",()=>{
    const navbar  = document.getElementById("navBar");
    window.onscroll =()=>{
        if(document.body.scrollTop>180 || document.documentElement.scrollTop >180){
            navbar.style.backgroundColor = "rgba(8, 14, 41, 0.870)";
        }else{
            navbar.style.backgroundColor = "rgba(0,0,0,0)";
        }
    }
});

document.querySelector("#mottoSection").addEventListener("mouseover",()=>{
    const mottoCards = document.querySelectorAll(".mottoCard");
    mottoCards.forEach((card)=>{
        card.classList.add("targetHover");
    })
});

document.querySelector("#mottoSection").addEventListener("mouseenter",()=>{
    const mottoCards = document.querySelectorAll(".mottoCard");
    mottoCards.forEach((card)=>{
        card.classList.add("targetHover");
    })
});

document.querySelector("#home").addEventListener("click",()=>{
    document.querySelector('#Container').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#logoDiv").addEventListener("click",()=>{
    window.location.href = './index.html';
});

document.querySelector("#about").addEventListener("click", () => {
    document.querySelector('#aboutSection').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#event").addEventListener("click", () => {
    document.querySelector('#eventSection').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#board").addEventListener("click", () => {
    document.querySelector('#meetSection').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#contact").addEventListener("click", () => {
    document.querySelector('#footerSection').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#homeLogo").addEventListener("click",()=>{
    document.querySelector('#Container').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#aboutLogo").addEventListener("click", () => {
    document.querySelector('#aboutSection').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#eventLogo").addEventListener("click", () => {
    document.querySelector('#eventSection').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#boardLogo").addEventListener("click", () => {
    document.querySelector('#meetSection').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#contactLogo").addEventListener("click", () => {
    document.querySelector('#footerSection').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#contactUs").addEventListener("click", () => {
    document.querySelector('#footerSection').scrollIntoView({ behavior: 'smooth' });
});

document.querySelector("#learnMore").addEventListener("click", () => {
    window.location.href = 'https://www.instagram.com/bullsandbears_vit/';
});

document.querySelector("#learnMoreAbout").addEventListener("click", () => {
    window.location.href = 'https://www.instagram.com/bullsandbears_vit/';
});

