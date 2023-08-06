<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AbuDhabiTerhal</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        /* for tablets only */
@media only screen and (max-width:1024px) and (max-height:768px){
    body{
        background-color: skyblue;
        margin: 0;
        padding: 0;
    }    
    *{
        font-family: 'Monaco',monospace;
    }
}
/* for desktop only */
@media only screen and (min-width:1024px) and (min-height:768px){
    *{
        font-family: 'Monaco',monospace;
    }
    body{
        margin: 0;
        padding: 0;
    }
    .top{
        position: relative;
        background-color: #f3f3f3;
        color: #72728c;
        text-shadow: 0px 5px 4px rgb(183, 183, 183);
        width: 100%;
        height: 50px;
        justify-content: space-between;
        display: inline-block; 
        padding: 0 10px;
    }
    .center{
        padding: 15px 0;
    }
    .banner{
        background-color: rgba(0,0,0,0.45);
        height:150px;
        position: relative;
        display: inline-block;
        justify-content: center;
        align-items: center;
        color: white;
    }
    .bottom-banner{
        background-color: rgba(0,0,0,0.35);
        height: 550px;
        display: flexbox;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding-top:50px;
    }
    .bottom-text{
        font-size: 55px;
    }
    .box{
        background-color: rgba(255,255,255,0.35);
        width: 960px;
        height: auto;
        padding-top: 50px;
        padding-bottom: 50px;
        border-radius: 16px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
    .smol-border{
        background-color: white;
        height: 75px;
        align-items: center;
        display: flex;
        width: 750px;
    }
    .smoler-border-outside{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .smoler-border{
        border-radius: 8px;
        background-color: white;
        height: 50px;
        width: 250px;
        display: flex;
        position: relative;
        top: 5px;
        align-items: center;
        justify-content: center;
    }
    .green{
        color: #19c880;
    }
    .bar{
        color:#19c880;
        transform: scale(2);
        margin: auto;
    }
    .indicator{
        color: white;
        transition-duration: 0.3s;
        display: flex;
        flex-direction: column;
        margin: auto;
    }
    .indicator:hover{
        color: #19c880;
    }
    .image{
        position: absolute;
        left: 0;
        top: 50px;
        width: 100%;
        z-index: -100;
    }
    .home_content{
        width: 960px;
        display: flex;
        flex-wrap: wrap;
        margin: auto;
    }
    .home_content_card{
        position: relative;
        width: 300px;
        margin: auto;
        height: 450px;
        border: 1px solid lightgrey;
        overflow: hidden;
    }
    .footer{
        width: 100%;
        background-color:rgba(0,0,0,0.35);
        padding: 8px;
    }
    .footer_inner{
        width: 960px;
        margin: auto;
    }
    .footer_inner_top{
        display: flex;
    }
    .footer_inner_bottom{
        display: flex;
        justify-content: space-between;
        color: white;
    }
    .footer_inner_bottom_right{
        display: flex;
    }
    .admin-smol-border{
        background-color: white;
        width: 750px;
        text-align: center;
        align-items: center;
        margin: auto;
    }
    .admin-addplace-smol-border{
        border-radius: 8px;
        background-color: rgb(229, 229, 229);
        height: 35px;
        width: 150px;
        top: 5px;
        z-index: -100;
        display: flex;
        position: relative;
        align-items: center;
        padding-left: 15px;
        padding-top: 15px;
    }
    .admin-addplace-border{
        background-color: rgb(229, 229, 229);
        width: 960px;
        border-radius: 8px;
        height: 50px;
        padding-left: 15px;
        padding-top: 10px;
    }
    .manage_place_green{
        background-color:#19c880 ;
        color: white;
    }
    .home-explore-animation{
        box-shadow: 0 1px 2px rgb(0, 0, 0,0.15);
        transition-duration: 0.3s;
        background-color: white;
        margin-bottom: 100px;
    }
    .home-explore-animation:hover{
        box-shadow: 0 15px 15px rgb(0, 0, 0,0.15);
        transform: scale(1.1,1.1);
    }
    .Mymodal-back{
        display: none;
        background-color: rgba(0,0,0,0.55);
        height: 100%;
        width: 100%;
        z-index: 100;
        position: fixed;
        top: 0;
    }
    .Mymodal{
        position: absolute;
        top: 100px;
        left: 50%;
        transform: translateX(-50%);
        background-color: white;
        z-index: 1000;
    }
    .close{
        position: absolute;
        top: 10px;
        right: 15px;
    }
    .close:hover{
        cursor:pointer ;
    }
    .multi-line-ellipsis{
        width: 300px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        color:  black;
    }
    .word-break{
        overflow-wrap: break-word;
        word-wrap: break-word;
    }
    .gallery-card{
        flex-wrap: wrap;
        display: flex;
    }
    .galleryModal{
        display: none;
        position: fixed;
        top: 0;
        height: 100%;
        width: 100%;
        background-color:rgba(0,0,0,0.55);
    }
    .smol-galleryModal{
        position: absolute;
        top: 200px;
        left: 50%;
        transform: translateX(-50%);
    }
    .galleryClose{
        position: absolute;
        color: #19c880;
        top: 50px;
        right: 50px;
        scale: 3;
    }
    .galleryClose:hover{
        cursor: pointer;
    }
    img{
        object-fit: cover;
    }
    .div{
        width: 500px;
        height: 100px;
        white-space: nowrap;
        text-overflow: ellipsis;
        /* display: block; */
        overflow: hidden
    }
}
    </style>
</head>
<body>
    <div class="div"> </div>
    <div class="container mx-auto justify-content-center text-center">
        <div class="col-12 justify-content-center mt-5 text-center">
            <p style="color:grey;">TOP 6 ABU DHABI TOURIST ATTRACTIONS</p>
            <h2>Explore and be Inspired</h2>
        </div>
        <div class="home_content">
            <div class="home_content_card home-explore-animation" onclick="location.href='landing.php?id=<?=$row['id']?>'">
                <img src="" style="width:300px;height:200px;" alt="">
                <p class="my-5 green">gmrejbhnefwiuhiuhbewuibhuifewhbuiweuhewihbfdbfi</p>
                <p class="px-4 multi-line-ellipsis">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, esse debitis aliquid laboriosam quidem nihil consequatur dignissimos corrupti eum nobis delectus iure facere earum ipsa assumenda veniam distinctio ducimus hic.</p>
            </div>
            <div class="home_content_card home-explore-animation" onclick="location.href='landing.php?id=<?=$row['id']?>'">
                <img src="" style="width:300px;height:200px;" alt="">
                <p class="my-5 green">gmrejbhnefwiuhiuhbewuibhuifewhbuiweuhewihbfdbfi</p>
                <p class="px-4 multi-line-ellipsis"></p>
            </div>
            <div class="home_content_card home-explore-animation" onclick="location.href='landing.php?id=<?=$row['id']?>'">
                <img src="" style="width:300px;height:200px;" alt="">
                <p class="my-5 green">gmrejbhnefwiuhiuhbewuibhuifewhbuiweuhewihbfdbfi</p>
                <p class="px-4 multi-line-ellipsis">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, esse debitis aliquid laboriosam quidem nihil consequatur dignissimos corrupti eum nobis delectus iure facere earum ipsa assumenda veniam distinctio ducimus hic.</p>
            </div>
        </div>
    </div>
    <script>
        let textlng=19
        let text="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, esse debitis aliquid laboriosam quidem nihil consequatur dignissimos corrupti eum nobis delectus iure facere earum ipsa assumenda veniam distinctio ducimus hic.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, esse debitis aliquid laboriosam quidem nihil consequatur dignissimos corrupti eum nobis delectus iure facere earum ipsa assumenda veniam distinctio ducimus hic.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, esse debitis aliquid laboriosam quidem nihil consequatur dignissimos corrupti eum nobis delectus iure facere earum ipsa assumenda veniam distinctio ducimus hic."
        let textarray=text.split(" ")
        if(textarray.length<=19){
            console.log(text)
        }else{
            let arraytemp=textarray.slice(0, 19).join(" ")
            console.log(arraytemp+textarray[20][0]+textarray[20][1]+textarray[20][2]+"......")
        }
    </script>
</body>
</html>