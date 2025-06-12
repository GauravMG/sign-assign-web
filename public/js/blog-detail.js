$(document).ready(function () {
    fetchBlogs()
})

async function fetchBlogs() {
    await postAPICall({
        endPoint: "/blog/list",
        payload: JSON.stringify({
            filter: {
                blogId: Number(blogId)
            },
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
                let blog = data[0]

                let mediaUrl = "";
                let isVideo = false;

                for (let k = 0; k < blog?.blogMedias?.length; k++) {
                    const media = blog.blogMedias[k];
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

                document.getElementById("blogTitle").innerText = blog.title

                if (isVideo) {
                    document.getElementById("blogMedia").innerHTML = `<video loop="" controls="true" playsinline="">
                        <source src="${mediaUrl}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>`
                } else {
                    document.getElementById("blogMedia").innerHTML = `<img src="${mediaUrl}" alt="${blog.title}" class="w-100 rounded">`
                }

                document.getElementById("blogDate").innerText = formatDateWithoutTime(blog.createdAt)

                document.getElementById("blogDescription").innerHTML = blog.description
            }
        }
    });
}