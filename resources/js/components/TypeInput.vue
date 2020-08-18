<template>
    <div class="row">
        <div class="col-lg-6" v-for="option in options" :key="option.value">
            <label class="kt-option">
                <span class="kt-option__control">
                    <span class="kt-radio">
                        <input type="radio" name="type" :value="option.value" v-model="value">
                        <span></span>
                    </span>
                </span>
                <span class="kt-option__label">
                    <span class="kt-option__head">
                        <span class="kt-option__title">
                            {{option.title}}
                        </span>
                    </span>
                    <span class="kt-option__body">
                        {{option.description}}
                    </span>
                </span>
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TypeInput",
        props: {
            options: Array,
            default: String
        },
        data(){
            return {
                value: this.default
            }
        },
        created(){
            this.$emit('set-value', this.default)
        },
        watch: {
            value: function (newValue, oldValue) {
                this.$emit('set-value', newValue)
            }
        },
    }
</script>

<style scoped>

</style>
