(()=>{"use strict";const e=window.wp.blocks,t=window.React,n=window.wp.i18n,l=window.wp.blockEditor,o=window.wp.components,a=JSON.parse('{"u2":"communikit/input-button"}');(0,e.registerBlockType)(a.u2,{edit:function({attributes:e,setAttributes:a}){const{button_type:u,button_label:i}=e;var r="submit"==u?"submit":"button";return(0,t.createElement)(t.Fragment,null,(0,t.createElement)("div",{...(0,l.useBlockProps)()},(0,t.createElement)("input",{type:r,value:i,disabled:!0})),(0,t.createElement)(l.InspectorControls,{key:"setting"},(0,t.createElement)(o.PanelBody,{title:"CommuniKit - Form",initialOpen:!0},(0,t.createElement)(o.PanelRow,null,(0,t.createElement)(o.__experimentalVStack,null,(0,t.createElement)(o.SelectControl,{label:(0,n.__)("Button type"),help:(0,n.__)("Choose the purpose of the button"),value:u,onChange:e=>{a({button_type:e})}},(0,t.createElement)("option",{value:"submit"},(0,n.__)("Submit")),(0,t.createElement)("option",{value:"reset"},(0,n.__)("Reset"))),(0,t.createElement)(o.__experimentalDivider,null),(0,t.createElement)(o.TextControl,{label:(0,n.__)("Button label"),help:(0,n.__)("Change the button label"),value:i,onChange:e=>{a({button_label:e})}}))))))},save:function(){return null}})})();