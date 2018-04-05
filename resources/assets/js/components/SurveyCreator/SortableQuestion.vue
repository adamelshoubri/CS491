<template lang="html">
    <div id="custom-question-content">
        <h6 class="card=subtitle">Sortable Items</h6>
        <div class="input-group" v-for="choice in this.question.choices" :key="choice.id">
            <!-- <span class="input-group-addon" id="basic-addon1">Item Text</span> -->
            <input type="text" placeholder="Item Text" class="form-control" aria-describedby="" v-model="choice.text" v-bind="choice">
            <button type="button" class="close float-right" aria-label="Close" @click="destroyChoice(choice.id)">
                <!-- <span aria-hidden="true">&times;</span> -->
            </button>
        </div>
        <button class="btn btn-success mt-3" @click="addNewSortableItem()">New Item</button>
    </div>
</template>

<script>
export default {
  data() {
    return {
      lastId: 0
    }
  },
  props: ['question'],
  methods: {
    destroyChoice(id) {
      for (var i = 0; i < this.question.choices.length; i++) {
        if (this.question.choices[i].id == id) {
          this.question.choices.splice(i, 1);
        }
      }
    },
    addNewSortableItem() {
      this.question.choices.push({
        id: this.lastId++,
        text: null
      });
    }
  }
}
</script>

<style lang="css">
</style>
