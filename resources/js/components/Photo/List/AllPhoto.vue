<template>
    <div>
        <div class="d-flex py-5">
            <div>
                <ErrorsModalWindow v-if="this.$store.state.isUploadError"></ErrorsModalWindow>
                <UploadPhotosComponent></UploadPhotosComponent>
            </div>
            <div class="px-3">Панель команд</div>
        </div>
        <div class="d-flex" v-if="photos.length > 0">
            <OnePhoto v-for="photo in photos" :key="photo.id" :photo="photo"
                        class="mx-2"
            ></OnePhoto>
        </div>
        <div v-else>
            <p>Фотографий нет</p>
        </div>
    </div>
</template>

<script>
    import Section from '../../Global/Section'
    import GroupPhoto from './GroupPhoto'
    import OnePhoto from "./OnePhoto";
    import { mapGetters } from 'vuex'
    import ListPhoto from "../../../store/modules/ListPhoto";
    import ErrorsModalWindow from "../Upload/ErrorsModalWindow";
    import UploadPhotosComponent from "../Upload/UploadPhotosComponent";

    export default {
        name: "AllPhoto",
        components: {Section, OnePhoto, ErrorsModalWindow, UploadPhotosComponent},
        props: {
            paginateCount: {
                type: Number,
                default: 40
            }
        },
        computed: {
            ...mapGetters([
                'photos'
            ]),
        },
        methods: {
            getPhotos() {
                // this.$store.dispatch('getPhotos', null, { root:true });
            }
        },
        created() {
            this.$store.dispatch('getPhotos');
        },
    }
</script>

<style scoped>

</style>