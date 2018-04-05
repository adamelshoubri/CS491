<template lang="html">
    <div id="custom-question-content">
        <h6 class="card=subtitle">Response type</h6>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" :name="question.id" id="exampleRadios1" value="shorttext" v-model="question.type" checked>
            Short text
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" :name="question.id" id="exampleRadios2" value="textarea" v-model="question.type">
            Textarea
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" :name="question.id" id="exampleRadios2" value="number" v-model="question.type">
            Number
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" :name="question.id" id="exampleRadios2" value="date" v-model="question.type">
            Date
          </label>
        </div>
    </div>
</template>

<script>
export default {
    props: ['question']
}
</script>
