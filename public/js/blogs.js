$(document).ready(function () {
    fetchBlogs()
})

async function fetchBlogs() {
    await postAPICall({
        endPoint: "/blog/list",
        payload: JSON.stringify({
            filter: {},
            range: {
                all: true
            },
            sort: [{
                orderBy: "createdAt",
                orderDir: "desc"
            }],
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, data } = response;

            if (success) {
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

                    html.push(`<div class="inner-card">
                        <div class="p-3 m-0">` +
                        (isVideo
                            ? `<video class="w-100 rounded" muted="" loop="" playsinline="">
                                     <source src="${mediaUrl}" type="video/mp4">
                                     Your browser does not support the video tag.
                                   </video>`
                            : `<img src="${mediaUrl}" alt="${data[i].title}" class="w-100 rounded">`) +
                        `</div>
                        <div class="px-3 mt-0">
                            <h6>by signassi | ${formatDateWithoutTime(data[i].createdAt)} | Signage</h6>
                            <h5>${data[i].title}</h5>
                            <p>${getTextFromHTML(data[i].description, 60)}</p>
                            <a href="/learning-center/${getLinkFromName(data[i].title)}-${data[i].blogId}">Read More <span><svg class="svg-inline--fa fa-arrow-right-long" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right-long" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>`);
                }

                document.getElementById("blogsList").innerHTML = html.join("")
            }
        }
    });
}