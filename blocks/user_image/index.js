(()=>{"use strict";const e=window.wp.blocks,t=window.React,n=(window.wp.i18n,window.wp.blockEditor),o=window.wp.components,r=JSON.parse('{"u2":"communikit/user-image"}');(0,e.registerBlockType)(r.u2,{edit:function({attributes:e,setAttributes:r}){const{rounded:l}=e,i=(0,t.useRef)(null);return null!=i.current&&(l?i.current.classList.add("comkgb-image-rounded"):i.current.classList.remove("comkgb-image-rounded")),(0,t.createElement)(t.Fragment,null,(0,t.createElement)("div",{...(0,n.useBlockProps)()},(0,t.createElement)("img",{ref:i,class:"comko-image"})),(0,t.createElement)(n.InspectorControls,{key:"setting"},(0,t.createElement)(o.PanelBody,{title:"CommuniKit - User",initialOpen:!0},(0,t.createElement)(o.PanelRow,null,(0,t.createElement)(o.CheckboxControl,{label:"Rounded image",help:"Choose whether the profile image will be round or not",checked:l,onChange:e=>r({rounded:e})})))))},save:function(){return null}})})();