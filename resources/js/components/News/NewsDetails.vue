<template>
    <v-container class="my-5 my-md-16">
        <v-row>
            <v-col cols="12" md="4">
                <!-- Displaying image with max width -->
                <v-img :src="`${baseUrl}${blog.image}`" max-width="100%" alt="Blog Image" />


            </v-col>
            <v-col cols="12" md="8">
                <!-- Displaying title -->
                <div class="font-weight-bold" style="font-size: 24px; color: black;">
                    {{ blog.title }}
                </div>

                <!-- Displaying author -->
                <div class="mt-2" style="color: grey;">
                    <strong>Author:</strong> {{ blog.author }}
                </div>

                <!-- Displaying content -->
                <div v-if="blog && blog.content" class="content" style="color: black; font-size: 16px;">
                    {{ blog.content }}
                </div>
            </v-col>
        </v-row>

        <div class="mt-10 mt-md-16 font-weight-black text-body-1 mb-3 text-dark-blue">
            Share This Post
        </div>

        <div class="d-flex mb-10 mb-md-16">
            <div class="pa-0 share-links mr-2" @click="copyLink">
                <v-img :src="linkImg" width="30px"></v-img>
            </div>
            <div class="pa-0 share-links mr-2" @click="shareToLinkedIn">
                <v-img :src="linkedIn" width="30px"></v-img>
            </div>
            <div class="pa-0 share-links mr-2" @click="shareOnTwitter">
                <v-img :src="twitter" width="30px"></v-img>
            </div>
            <div class="pa-0 share-links mr-2" @click="shareToFacebook">
                <v-img :src="facebook" width="30px"></v-img>
            </div>
        </div>

        <v-divider class="mt-5" thickness="2" color="black" style="opacity: 1"></v-divider>
    </v-container>
</template>

<script>
import linkImg from "/resources/assets/share/link.png";
import linkedIn from "/resources/assets/share/linkedIn.png";
import twitter from "/resources/assets/share/twitter.png";
import facebook from "/resources/assets/share/facebook.png";
import { watch } from "vue";

export default {
    props: {
        blog: {
            type: Object,
            default: () => {
                return {};
            },
        },
    },
    data() {
        return {
        };
    },
    setup(props) {
        console.log(props.blog.content);

        // Watch for changes in the blog prop
        watch(() => props.blog, (newBlog) => {
            console.log(newBlog);
        });

        return {
            linkImg,
            linkedIn,
            twitter,
            facebook,
        };
    },
    methods: {
        shareToFacebook() {
            const urlToShare = window.location.href;
            const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
                urlToShare
            )}`;
            window.open(
                facebookShareUrl,
                "Share on Facebook",
                "width=600,height=400"
            );
        },
        shareToLinkedIn() {
            const urlToShare = window.location.href;
            const linkedInShareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(
                urlToShare
            )}`;
            window.open(
                linkedInShareUrl,
                "Share on LinkedIn",
                "width=600,height=400"
            );
        },
        shareOnTwitter() {
            const tweetText = "Check out this link: ";
            const urlToShare = window.location.href;
            const twitterShareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(
                tweetText
            )}&url=${encodeURIComponent(urlToShare)}`;
            window.open(
                twitterShareUrl,
                "Share on Twitter",
                "width=600,height=400"
            );
        },
        copyLink() {
            const urlToCopy = window.location.href;
            navigator.clipboard
                .writeText(urlToCopy)
                .then(() => {
                    this.snackbar = true;
                })
                .catch((error) => {
                    console.error("Unable to copy link to clipboard", error);
                });
        },
    },
};
</script>

<style lang="scss" scoped>
:deep(.content) {
    img {
        max-width: 100%;
    }
}

.share-links {
    cursor: pointer;
    border-radius: 50%;
    overflow: hidden;
}

* {
    font-family: "Poppins", sans-serif;
}
</style>
