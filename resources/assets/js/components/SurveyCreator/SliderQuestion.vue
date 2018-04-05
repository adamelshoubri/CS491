<template lang="html">
    <div id="custom-question-content">
        <h6 class="card=subtitle">Slider Properties</h6>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Min Value</span>
            <input type="number" class="form-control" aria-describedby="questionHelp" :value="question.slidermin" v-model="question.slidermin">
            <span class="input-group-addon" id="basic-addon1">Max Value</span>
            <input type="number" class="form-control" aria-describedby="questionHelp" :value="question.slidermax" v-model="question.slidermax">
        </div>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Increment</span>
            <input type="number" class="form-control" aria-describedby="questionHelp" :value="question.increment" v-model="question.increment">
        </div>
    </div>
</template>

<script>
export default {
    props: ['question']
}
</script>

<style lang="css">
</style>
