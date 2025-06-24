let page = 1
let pageSize = 10
let total = 0

$(document).ready(function () {
    fetchBlogs()
})

function loadMore() {
    page++

    fetchBlogs()
}

async function fetchBlogs() {
    await postAPICall({
        endPoint: "/blog/list",
        payload: JSON.stringify({
            filter: {},
            range: {
                page,
                pageSize
            },
            sort: [{
                orderBy: "createdAt",
                orderDir: "desc"
            }],
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, data, metadata } = response;

            if (success) {
                total = metadata.total
                if (page * pageSize < total) {
                    document.getElementById("load-more-container").classList.remove("d-none")
                } else {
                    document.getElementById("load-more-container").classList.add("d-none")
                }

                let html = [];

                for (let i = 0; i < data?.length; i++) {
                    let mediaUrl = "";
                    let isVideo = false;

                    for (let k = 0; k < data[i]?.blogMedias?.length; k++) {
                        const media = data[i].blogMedias[k];
                        const mediaUrlClean = (media.mediaUrl ?? "").trim();

                        if (mediaUrlClean === "") continue;

                        if (media.mediaType?.indexOf("image") >= 0) {
                            mediaUrl = mediaUrlClean;
                            isVideo = false;
                            break;
                        } else if (media.mediaType?.indexOf("video") >= 0 && mediaUrl === "") {
                            mediaUrl = mediaUrlClean;
                            isVideo = true;
                            break
                        }
                    }

                    if (mediaUrl === "") {
                        mediaUrl = `${BASE_URL}images/no-preview-available.jpg`;
                        isVideo = false;
                    }

                    html.push(`<div class="inner-card" onclick="">
                        <div class="p-3 m-0 for-icon">` +
                        (isVideo
                            ? `<video class="w-100 rounded" muted="" loop="" playsinline="">
                                     <source src="${mediaUrl}" type="video/mp4">
                                     Your browser does not support the video tag.
                                   </video>
                                   <img src="${'images/play.png'}" alt="" class="play-icon">`
                            : `<img src="${mediaUrl}" alt="${data[i].title}" class="w-100 rounded">`) +
                        `</div>
                        <div class="px-3 mt-2">
                            <h6>by signassi | ${formatDateWithoutTime(data[i].createdAt)} | Signage</h6>
                            <h5 class="mb-4">${sliceTextWithEllipses(data[i].title, 60)}</h5>
                            <a href="/learning-center/${getLinkFromName(data[i].title)}-${data[i].blogId}">Read More <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                        </div>
                    </div>`);
                }

                document.getElementById("blogsList").innerHTML += html.join("")
            }
        }
    });
}