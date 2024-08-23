(()=>{"use strict";const e=window.wp.blocks,t=window.React,n=window.wp.i18n,l=window.wp.blockEditor,o=window.wp.components,i=JSON.parse('{"u2":"communikit/input-form"}');(0,e.registerBlockType)(i.u2,{edit:function({attributes:e,setAttributes:i}){const{visibility:r,form_type:a,forwarding:c,post:u}=e;return(0,t.createElement)(t.Fragment,null,(0,t.createElement)("form",null,(0,t.createElement)("div",{...(0,l.useBlockProps)()},(0,t.createElement)(l.InnerBlocks,null))),(0,t.createElement)(l.InspectorControls,{key:"setting"},(0,t.createElement)(o.PanelBody,{title:"CommuniKit - Form",initialOpen:!0},(0,t.createElement)(o.PanelRow,null,(0,t.createElement)(o.__experimentalVStack,null,(0,t.createElement)(o.SelectControl,{label:(0,n.__)("Visible when..."),help:(0,n.__)("Choose, when the form should be visible"),value:r,onChange:e=>i({visibility:e})},(0,t.createElement)("option",{value:"both"},(0,n.__)("always")),(0,t.createElement)("option",{value:"logged"},(0,n.__)("logged in")),(0,t.createElement)("option",{value:"unlogged"},(0,n.__)("not logged in"))),(0,t.createElement)(o.__experimentalDivider,null),(0,t.createElement)(o.SelectControl,{label:(0,n.__)("Form type"),help:(0,n.__)("Purpose of the current CommuniKit-form"),value:a,onChange:e=>i({form_type:e})},(0,t.createElement)("option",{value:"log_in"},(0,n.__)("Log in")),(0,t.createElement)("option",{value:"sign_in"},(0,n.__)("Registration")),(0,t.createElement)("option",{value:"edit_data"},(0,n.__)("Edit user data"))),"sign_in"==a&&(0,t.createElement)(t.Fragment,null,(0,t.createElement)(o.__experimentalDivider,null),(0,t.createElement)(o.CheckboxControl,{label:(0,n.__)("Forwarding"),help:(0,n.__)("Redirect the user after submitting"),checked:c,onChange:e=>i({forwarding:e})}),c&&(0,t.createElement)(l.__experimentalLinkControl,{searchInputPlaceholder:(0,n.__)("Page the form forwards to..."),value:u,settings:[{id:"opensInNewTab",title:"Open page in a new tab"}],onChange:e=>i({post:e}),withCreateSuggestion:!0,createSuggestion:t=>i({post:{...e.post,title:t,type:"custom-url",id:Date.now(),url:t}}),createSuggestionButtonText:e=>"${newValue}"})))))))},save:function(){return(0,t.createElement)(l.InnerBlocks.Content,null)}})})();