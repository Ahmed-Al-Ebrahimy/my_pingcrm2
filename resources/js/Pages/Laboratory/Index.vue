<template>
<app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden shadow-xl p-3  rounded sm:rounded-lg">
                    <div class="mb-2 flex justify-between">
                        <search-filter v-model="form.search" class="w-full max-w-sm mr-4" @reset="reset">
                            <label class="block text-gray-700">Trashed:</label>
                            <select v-model="form.trashed" class="mt-1 w-full form-select">
                            <option :value="null" />
                            <option value="with">With Trashed</option>
                            <option value="only">Only Trashed</option>
                            </select>
                        </search-filter>
                    </div>
                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="bg-banafsagy-900 text-samaee-900">
                                    <th class="px-2 py-1 text-sm font-bold text-left">Edit</th>
                                    <th class="px-2 py-1 text-sm font-bold text-left">ID</th>
                                    <th class="px-2 py-1 text-sm font-bold text-left">Name</th>
                                    <th class="px-2 py-1 text-sm font-bold text-left">Created_at</th>
                                    <th class="px-2 py-1 text-sm font-bold text-left">Updated_at</th>
                                </tr>
                            </thead>
                            <tr v-for="(patient, index) in patients.data" :key="index"  class="font-medium text-gray-800 hover:bg-purple-400 focus-within:bg-gray-100 " :class="{'bg-purple-300': index % 2 === 0}">
                                <td class="border-t w-px ">
                                    <inertia-link class="px-4 flex outline-none  items-center" :href="route('laboratory.edit', patient.id)" tabindex="-1">
                                    <icon name="edit3" class="block w-6 h-6 "/>
                                    </inertia-link>
                                </td>
                                <td class="border-t">
                                    <inertia-link class="px-2 py-1 outline-none text-sm flex items-center" :href="route('laboratory.edit', patient.id)" tabindex="-1">
                                    {{ patient.id }}
                                    </inertia-link>
                                </td>
                                <td class="border-t">
                                    <inertia-link class="px-2 py-1 outline-none  text-sm flex items-center" :href="route('laboratory.edit', patient.id)" tabindex="-1">
                                    {{ patient.name }}
                                    </inertia-link>
                                </td>

                                <td class="border-t">
                                    <inertia-link class="px-2 py-1 outline-none  text-sm flex items-center" :href="route('laboratory.edit', patient.id)" tabindex="-1">
                                    {{moment(patient.created_at).format('YYYY-MM-DD')}}
                                    </inertia-link>
                                </td>
                                <td class="border-t">
                                    <inertia-link class="px-2 py-1 outline-none  text-sm flex items-center" :href="route('laboratory.edit', patient.id)" tabindex="-1">
                                    {{moment(patient.updated_at).format('YYYY-MM-DD')}}
                                    </inertia-link>
                                </td>

                            </tr>
                            <tr v-if="patients.data.length === 0">
                                <td class="border-t px-6 py-4" colspan="6">No patients found.</td>
                            </tr>
                        </table>
                    </div>
                    <pagination :links="patients.links" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Icon from '@/Shared/Icon'
    import mapValues from 'lodash/mapValues'
    import Pagination from '@/Shared/Pagination'
    import pickBy from 'lodash/pickBy'
    import SearchFilter from '@/Shared/SearchFilter'
    import throttle from 'lodash/throttle'
    export default {
        components: {
            AppLayout,
            Welcome,
            Pagination,
            Icon,
            SearchFilter,
        },
  props: {
    patients: Object,
    filters: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('patients', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },

    }
</script>


