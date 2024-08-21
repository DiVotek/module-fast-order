<x-modal :event="$modalEvent" title="_t('Fast order')">
   <div class="flex flex-col space-y-4">
      <div class="flex flex-col space-y-2">
         <label for="name" class="text-sm font-semibold">{{_t('Name')}}</label>
         <input type="text" wire:model="name" id="name" class="input input-bordered" placeholder="{{_t('Name')}}" />
         <x-error :name="name" class="text-xs text-error" />
      </div>
      <div class="flex flex-col space-y-2">
         <label for="phone" class="text-sm font-semibold">{{_t('Phone')}}</label>
         <input type="text" wire:model="phone" id="phone" class="input input-bordered" placeholder="{{_t('Phone')}}" />
         <x-error :name="phone" class="text-xs text-error" />
      </div>
      <div.flex.justify-end>
         <x-button class="btn btn-dark" wire:click="submit" aria-label="{{_t('Fast order')}}">{{_t('Fast order')}}</x-button>
      </div.flex.justify-end>
   </div>
</x-modal>
